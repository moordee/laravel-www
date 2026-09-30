@extends('layouts.kas-app')

{{--
  Halaman Anggota menampilkan data anggota dan status iuran dari API /api/anggota.
  Tambah, edit, hapus, dan toggle status disimpan melalui controller Eloquent.
--}}

@section('title', 'Anggota')

@section('content')
  <div class="list-header">
    <div class="t" id="anggotaFilter">Anggota Kelas</div>
    <button class="btn-small" id="btnTambahAnggota">+ Tambah anggota</button>
  </div>
  <div class="member-list" id="memberList"></div>
  <div class="member-hint">Klik status untuk menandai Lunas/Belum &middot; pakai ikon di kanan untuk edit atau hapus.</div>

  <div class="modal-backdrop" id="memberModalBackdrop">
    <div class="modal-card">
      <h3 id="memberModalTitle">Tambah anggota</h3>
      <div class="field">
        <label>Nama</label>
        <input type="text" id="memberNameInput" placeholder="Nama lengkap">
      </div>
      <div class="field">
        <label>Status iuran bulan ini</label>
        <select id="memberStatusInput">
          <option value="unpaid">Belum lunas</option>
          <option value="paid">Lunas</option>
        </select>
      </div>
      <div class="form-msg" id="memberModalMsg" style="margin-bottom:0;"></div>
      <div class="modal-actions">
        <button class="btn-ghost" id="memberModalCancel">Batal</button>
        <button class="btn-small" id="memberModalSave">Simpan</button>
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

  let anggota = [];
  let confirmDeleteIdx = null;
  let editingIdx = null;

  async function fetchJson(url, options = {}) {
    const response = await fetch(url, {
      credentials: 'same-origin',
      ...options,
      headers: {
        ...apiHeaders,
        ...(options.headers || {})
      }
    });

    const text = await response.text();
    const payload = text ? JSON.parse(text) : {};

    if (!response.ok) {
      throw new Error(payload.message || 'Terjadi kesalahan saat memuat data.');
    }

    return payload;
  }

  function initials(name = '') {
    return name.trim().split(/\s+/).filter(Boolean).slice(0, 2).map(w => w[0]).join('').toUpperCase() || 'A';
  }

  function renderAnggota() {
    const lunas = anggota.filter(a => a.status === 'paid').length;
    document.getElementById('anggotaFilter').textContent = `Anggota Kelas (${lunas}/${anggota.length} Lunas)`;

    document.getElementById('memberList').innerHTML = anggota.map((a, i) => {
      if (confirmDeleteIdx === i) {
        return `
          <div class="member-row">
            <div class="member-name"><span class="member-initial">${initials(a.nama)}</span>${a.nama}</div>
            <div class="confirm-inline">
              Hapus anggota ini?
              <button class="yes" data-action="confirm-delete" data-idx="${i}">Ya, hapus</button>
              <button class="no" data-action="cancel-delete" data-idx="${i}">Batal</button>
            </div>
          </div>
        `;
      }
      return `
        <div class="member-row">
          <div class="member-name" data-action="toggle-status" data-idx="${i}">
            <span class="member-initial">${initials(a.nama)}</span>${a.nama}
          </div>
          <button class="status-pill ${a.status === 'paid' ? 'paid' : 'unpaid'}" data-action="toggle-status" data-idx="${i}">
            ${a.status === 'paid' ? 'Lunas' : 'Belum'}
          </button>
          <div class="member-actions">
            <button class="icon-action" title="Edit" data-action="edit" data-idx="${i}">&#9998;</button>
            <button class="icon-action danger" title="Hapus" data-action="delete" data-idx="${i}">&#128465;</button>
          </div>
        </div>
      `;
    }).join('');

    document.querySelectorAll('#memberList [data-action]').forEach(el => {
      el.addEventListener('click', async () => {
        const idx = parseInt(el.dataset.idx, 10);
        const action = el.dataset.action;
        const item = anggota[idx];

        if (!item) return;

        if (action === 'toggle-status') {
          const nextStatus = item.status === 'paid' ? 'unpaid' : 'paid';
          try {
            await fetchJson(`/api/anggota/${item.id}`, {
              method: 'PUT',
              body: JSON.stringify({ nama: item.nama, status: nextStatus })
            });
            item.status = nextStatus;
            renderAnggota();
          } catch (error) {
            alert(error.message || 'Gagal mengubah status anggota.');
          }
        } else if (action === 'edit') {
          openMemberModal(idx);
        } else if (action === 'delete') {
          confirmDeleteIdx = idx; renderAnggota();
        } else if (action === 'confirm-delete') {
          try {
            await fetchJson(`/api/anggota/${item.id}`, { method: 'DELETE' });
            anggota.splice(idx, 1);
            confirmDeleteIdx = null;
            renderAnggota();
          } catch (error) {
            alert(error.message || 'Gagal menghapus anggota.');
          }
        } else if (action === 'cancel-delete') {
          confirmDeleteIdx = null;
          renderAnggota();
        }
      });
    });
  }

  async function loadAnggota() {
    try {
      const payload = await fetchJson('/api/anggota');
      anggota = Array.isArray(payload.data) ? payload.data : [];
      renderAnggota();
    } catch (error) {
      document.getElementById('memberList').innerHTML = '<div class="member-row"><div class="member-name">Gagal memuat data anggota.</div></div>';
      console.error(error);
    }
  }

  function openMemberModal(idx) {
    editingIdx = (typeof idx === 'number') ? idx : null;
    const nameInput = document.getElementById('memberNameInput');
    const statusInput = document.getElementById('memberStatusInput');
    const title = document.getElementById('memberModalTitle');
    document.getElementById('memberModalMsg').textContent = '';
    if (editingIdx !== null) {
      title.textContent = 'Edit anggota';
      nameInput.value = anggota[editingIdx].nama;
      statusInput.value = anggota[editingIdx].status;
    } else {
      title.textContent = 'Tambah anggota';
      nameInput.value = '';
      statusInput.value = 'unpaid';
    }
    document.getElementById('memberModalBackdrop').classList.add('open');
  }

  function closeMemberModal() {
    document.getElementById('memberModalBackdrop').classList.remove('open');
    editingIdx = null;
  }

  document.getElementById('btnTambahAnggota').addEventListener('click', () => openMemberModal(null));
  document.getElementById('memberModalCancel').addEventListener('click', closeMemberModal);
  document.getElementById('memberModalBackdrop').addEventListener('click', (e) => {
    if (e.target.id === 'memberModalBackdrop') closeMemberModal();
  });

  document.getElementById('memberModalSave').addEventListener('click', async () => {
    const nama = document.getElementById('memberNameInput').value.trim();
    const status = document.getElementById('memberStatusInput').value;
    const msg = document.getElementById('memberModalMsg');

    if (!nama) {
      msg.textContent = 'Nama anggota belum diisi.';
      return;
    }

    try {
      if (editingIdx !== null) {
        const item = anggota[editingIdx];
        const payload = await fetchJson(`/api/anggota/${item.id}`, {
          method: 'PUT',
          body: JSON.stringify({ nama, status })
        });
        anggota[editingIdx] = payload.data;
      } else {
        const payload = await fetchJson('/api/anggota', {
          method: 'POST',
          body: JSON.stringify({ nama, status })
        });
        anggota.push(payload.data);
      }

      closeMemberModal();
      renderAnggota();
    } catch (error) {
      msg.textContent = error.message || 'Gagal menyimpan data anggota.';
    }
  });

  loadAnggota();
</script>
@endpush
