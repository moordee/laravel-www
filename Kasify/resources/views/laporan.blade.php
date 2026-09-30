@extends('layouts.kas-app')

{{--
  Halaman Laporan menampilkan ringkasan keuangan, tren bulanan,
  total pemasukan dan pengeluaran, serta tabel rincian transaksi.
  Data yang tampil di sini seharusnya berasal dari API /api/transaksi,
  lalu diproses di frontend agar mudah dibaca tim.
--}}

@section('title', 'Laporan')

@section('content')
  <div class="list-header">
    <div class="t">Laporan Keuangan</div>
    <div class="filter">September 2026</div>
  </div>

  <div class="cards-row">
    <div class="stat-card"><div class="label">Total pemasukan</div><div class="value in-value" id="lapMasuk">&nbsp;</div></div>
    <div class="stat-card"><div class="label">Total pengeluaran</div><div class="value out-value" id="lapKeluar">&nbsp;</div></div>
    <div class="stat-card"><div class="label">Saldo akhir</div><div class="value" id="lapSaldo">&nbsp;</div></div>
  </div>

  <div class="section-title">Perbandingan 4 bulan terakhir</div>
  <div class="trend-chart" id="trendChart"></div>
  <div class="trend-legend">
    <span><span class="legend-dot in"></span>Pemasukan</span>
    <span><span class="legend-dot out"></span>Pengeluaran</span>
  </div>

  <div class="section-title">Rincian per kategori (bulan ini)</div>
  <div id="categoryList" style="margin-bottom:26px;"></div>

  <div class="section-title">Tabel laporan transaksi</div>
  <div class="table-wrap">
    <table class="report-table">
      <thead>
        <tr>
          <th>Tanggal</th><th>Keterangan</th><th>Kategori</th><th>Jenis</th>
          <th class="text-right">Jumlah</th><th class="text-right">Aksi</th>
        </tr>
      </thead>
      <tbody id="reportTableBody"></tbody>
      <tfoot>
        <tr><td colspan="4">Total pemasukan</td><td class="amt" id="tfootIn" style="color:var(--green-mid);"></td><td></td></tr>
        <tr><td colspan="4">Total pengeluaran</td><td class="amt" id="tfootOut" style="color:var(--red-ink);"></td><td></td></tr>
      </tfoot>
    </table>
  </div>

  <div class="modal-backdrop" id="txnModalBackdrop">
    <div class="modal-card">
      <h3>Edit transaksi</h3>
      <div class="field field-row">
        <div>
          <label>Jenis</label>
          <select id="txnJenisInput">
            <option value="in">Pemasukan</option>
            <option value="out">Pengeluaran</option>
          </select>
        </div>
        <div>
          <label>Tanggal</label>
          <input type="date" id="txnTanggalInput" required>
        </div>
      </div>
      <div class="field">
        <label>Keterangan</label>
        <input type="text" id="txnKetInput" placeholder="Keterangan transaksi">
      </div>
      <div class="field">
        <label>Kategori</label>
        <input type="text" id="txnKatInput" placeholder="misal: Iuran anggota">
      </div>
      <div class="field">
        <label>Jumlah (Rp)</label>
          <input type="number" id="txnJumlahInput" min="1" step="1" placeholder="0" required>
      </div>
      <div class="form-msg" id="txnModalMsg" style="margin-bottom:0;"></div>
      <div class="modal-actions">
        <button class="btn-ghost" id="txnModalCancel">Batal</button>
        <button class="btn-small" id="txnModalSave">Simpan</button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const apiHeaders = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
  };

  let saldo = 0;
  let transaksi = [];
  const trendData = [
    { label:'Jun', in:60, out:25 }, { label:'Jul', in:80, out:40 },
    { label:'Agu', in:65, out:32 }, { label:'Sep', in:90, out:35 },
  ];
  let confirmDeleteTxnIdx = null;
  let editingTxnIdx = null;

  function fmt(n) {
    return 'Rp ' + Number(n || 0).toLocaleString('id-ID');
  }

  function txnContribution(t) {
    return t.type === 'in' ? Number(t.amount || 0) : -Number(t.amount || 0);
  }

  async function fetchJson(url, options = {}) {
    const response = await fetch(url, {
      credentials: 'same-origin',
      ...options,
      headers: {
        ...apiHeaders,
        ...(options.headers || {})
      }
    });

    const payload = await response.json().catch(() => ({}));
    if (!response.ok) {
      throw new Error(payload.message || 'Terjadi kesalahan saat memproses data.');
    }

    return payload;
  }

  async function loadTransaksi() {
    try {
      const payload = await fetchJson('/api/transaksi');
      saldo = Number(payload.saldo || 0);
      transaksi = Array.isArray(payload.transactions) ? payload.transactions.map(item => ({
        id: item.id,
        desc: item.desc,
        cat: item.cat,
        date: item.date,
        type: item.type,
        amount: Number(item.amount || 0),
        transaction_date: item.transaction_date
      })) : [];
      renderLaporan();
    } catch (error) {
      console.error(error);
      document.getElementById('reportTableBody').innerHTML = '<tr><td colspan="6">Gagal memuat transaksi.</td></tr>';
    }
  }

  function renderLaporan(){
    const totalIn = transaksi.filter(t => t.type === 'in').reduce((s, t) => s + Number(t.amount || 0), 0);
    const totalOut = transaksi.filter(t => t.type === 'out').reduce((s, t) => s + Number(t.amount || 0), 0);
    document.getElementById('lapMasuk').textContent = fmt(totalIn);
    document.getElementById('lapKeluar').textContent = fmt(totalOut);
    document.getElementById('lapSaldo').textContent = fmt(saldo);

    document.getElementById('trendChart').innerHTML = trendData.map(m => `
      <div class="trend-col">
        <div class="trend-bars">
          <div class="trend-bar in" style="height:${m.in}%"></div>
          <div class="trend-bar out" style="height:${m.out}%"></div>
        </div>
        <div class="trend-label">${m.label}</div>
      </div>
    `).join('');

    const byCat = {};
    transaksi.forEach(t => {
      if (!byCat[t.cat]) byCat[t.cat] = { in:0, out:0 };
      byCat[t.cat][t.type] += Number(t.amount || 0);
    });
    const maxVal = Math.max(...Object.values(byCat).map(c => c.in + c.out), 1);
    document.getElementById('categoryList').innerHTML = Object.entries(byCat).map(([cat, v]) => {
      const total = v.in + v.out;
      const type = v.in > 0 ? 'in' : 'out';
      const width = Math.round((total / maxVal) * 100);
      return `
        <div class="category-row">
          <div class="cat-top"><span>${cat}</span><span class="amt ${type}">${type === 'in' ? '+' : '&minus;'}${fmt(total)}</span></div>
          <div class="bar-track"><div class="bar-fill ${type}" style="width:${width}%"></div></div>
        </div>
      `;
    }).join('');

    document.getElementById('reportTableBody').innerHTML = transaksi.map((t, i) => {
      if (confirmDeleteTxnIdx === i) {
        return `
          <tr>
            <td class="date">${t.date}</td><td>${t.desc}</td><td>${t.cat}</td>
            <td>${t.type === 'in' ? 'Pemasukan' : 'Pengeluaran'}</td>
            <td class="amt" style="color:${t.type === 'in' ? 'var(--green-mid)' : 'var(--red-ink)'};">${t.type === 'in' ? '+' : '&minus;'}${fmt(t.amount)}</td>
            <td class="actions-cell">
              <div class="row-confirm">
                Hapus?
                <button class="yes" data-taction="confirm-delete" data-tidx="${i}">Ya</button>
                <button class="no" data-taction="cancel-delete" data-tidx="${i}">Batal</button>
              </div>
            </td>
          </tr>
        `;
      }
      return `
        <tr>
          <td class="date">${t.date}</td><td>${t.desc}</td><td>${t.cat}</td>
          <td>${t.type === 'in' ? 'Pemasukan' : 'Pengeluaran'}</td>
          <td class="amt" style="color:${t.type === 'in' ? 'var(--green-mid)' : 'var(--red-ink)'};">${t.type === 'in' ? '+' : '&minus;'}${fmt(t.amount)}</td>
          <td class="actions-cell">
            <div class="row-actions">
              <button class="icon-action" title="Edit" data-taction="edit" data-tidx="${i}">&#9998;</button>
              <button class="icon-action danger" title="Hapus" data-taction="delete" data-tidx="${i}">&#128465;</button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
    document.getElementById('tfootIn').textContent = fmt(totalIn);
    document.getElementById('tfootOut').textContent = fmt(totalOut);

    document.querySelectorAll('#reportTableBody [data-taction]').forEach(el => {
      el.addEventListener('click', async () => {
        const idx = parseInt(el.dataset.tidx, 10);
        const action = el.dataset.taction;
        const item = transaksi[idx];
        if (!item) return;

        if (action === 'edit') {
          openTxnModal(idx);
        } else if (action === 'delete') {
          confirmDeleteTxnIdx = idx; renderLaporan();
        } else if (action === 'confirm-delete') {
          try {
            await fetchJson(`/api/transaksi/${item.id}`, { method: 'DELETE' });
            transaksi.splice(idx, 1);
            confirmDeleteTxnIdx = null;
            await loadTransaksi();
          } catch (error) {
            alert(error.message || 'Gagal menghapus transaksi.');
          }
        } else if (action === 'cancel-delete') {
          confirmDeleteTxnIdx = null; renderLaporan();
        }
      });
    });
  }

  function openTxnModal(idx) {
    editingTxnIdx = idx;
    const t = transaksi[idx];
    document.getElementById('txnModalMsg').textContent = '';
    document.getElementById('txnJenisInput').value = t.type;
    document.getElementById('txnTanggalInput').value = t.transaction_date || t.date;
    document.getElementById('txnKetInput').value = t.desc;
    document.getElementById('txnKatInput').value = t.cat;
    document.getElementById('txnJumlahInput').value = t.amount;
    document.getElementById('txnModalBackdrop').classList.add('open');
  }

  function closeTxnModal() {
    document.getElementById('txnModalBackdrop').classList.remove('open');
    editingTxnIdx = null;
  }

  document.getElementById('txnModalCancel').addEventListener('click', closeTxnModal);
  document.getElementById('txnModalBackdrop').addEventListener('click', (e) => {
    if (e.target.id === 'txnModalBackdrop') closeTxnModal();
  });

  document.getElementById('txnModalSave').addEventListener('click', async () => {
    if (editingTxnIdx === null) return;
    const type = document.getElementById('txnJenisInput').value;
    const transaction_date = document.getElementById('txnTanggalInput').value.trim();
    const description = document.getElementById('txnKetInput').value.trim();
    const category = document.getElementById('txnKatInput').value.trim();
    const amount = parseInt(document.getElementById('txnJumlahInput').value, 10);
    const msg = document.getElementById('txnModalMsg');

    if (!transaction_date || !description || !category || !Number.isSafeInteger(amount) || amount < 1) {
      msg.textContent = 'Lengkapi semua kolom dulu ya.';
      return;
    }

    try {
      const item = transaksi[editingTxnIdx];
      const payload = await fetchJson(`/api/transaksi/${item.id}`, {
        method: 'PUT',
        body: JSON.stringify({
          description,
          category,
          type,
          amount,
          transaction_date
        })
      });

      const updated = payload.data;
      transaksi[editingTxnIdx] = {
        id: updated.id,
        desc: updated.desc,
        cat: updated.cat,
        date: updated.date,
        type: updated.type,
        amount: Number(updated.amount || 0),
        transaction_date: updated.transaction_date
      };
      saldo = saldo - txnContribution(item) + txnContribution(transaksi[editingTxnIdx]);
      closeTxnModal();
      renderLaporan();
    } catch (error) {
      msg.textContent = error.message || 'Gagal memperbarui transaksi.';
    }
  });

  loadTransaksi();
</script>
@endpush
