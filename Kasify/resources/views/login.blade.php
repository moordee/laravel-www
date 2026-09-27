<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aplikasi Pengelolaan Kas Kelas</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;1,500&family=IBM+Plex+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root{
    --green-dark:#1F3B33;
    --green-mid:#2F6F4F;
    --green-badge:#DCE9DE;
    --paper:#FBF7EE;
    --paper-line:#E4DFCF;
    --paper-line-strong:#D6CFB8;
    --ink:#26241D;
    --ink-soft:#6B6656;
    --gold:#C9A227;
    --gold-soft:#E6C766;
    --red-ink:#A63D40;
    --red-ink-soft:#F1DEDD;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html,body{height:100%;}
  body{
    font-family:'IBM Plex Sans', sans-serif;
    background:var(--paper);
    color:var(--ink);
  }
  button, input, select, textarea{ font-family:inherit; }

  .view{ display:none; min-height:100vh; }
  .view.active{ display:flex; }

  /* ---------- LOGIN ---------- */
  #view-login{
    background:var(--green-dark);
    background-image:radial-gradient(circle at 15% 8%, #274A40 0%, var(--green-dark) 55%);
    align-items:center;
    justify-content:center;
    padding:40px 20px;
  }
  .login-wrap{ width:100%; max-width:380px; text-align:center; }
  .login-title{
    font-family:'Lora', serif;
    font-weight:600;
    font-style:italic;
    font-size:21px;
    line-height:1.5;
    color:#EDEAE0;
    margin-bottom:44px;
  }
  .login-card{
    background:#16281F;
    border:1px solid rgba(255,255,255,0.06);
    border-radius:14px;
    padding:28px 24px 24px;
    text-align:left;
  }
  .login-card h2{
    font-family:'Lora', serif;
    color:var(--gold-soft);
    font-size:16px;
    text-align:center;
    margin-bottom:22px;
    font-weight:600;
  }
  .login-card label{
    display:block;
    font-size:11.5px;
    color:#A9B8AE;
    margin-bottom:6px;
  }
  .login-card input{
    width:100%;
    padding:12px 13px;
    border-radius:6px;
    border:none;
    font-size:13.5px;
    margin-bottom:16px;
    background:#fff;
    color:var(--ink);
  }
  .login-card input:last-of-type{ margin-bottom:4px; }
  .login-error{
    font-size:11.5px;
    color:#E8A5A5;
    min-height:16px;
    margin-bottom:4px;
  }
  .btn-primary{
    width:100%;
    background:var(--gold);
    color:var(--green-dark);
    border:none;
    padding:12px;
    border-radius:6px;
    font-size:13.5px;
    font-weight:600;
    cursor:pointer;
    margin-top:14px;
    transition:background .15s ease;
  }
  .btn-primary:hover{ background:var(--gold-soft); }
  .login-hint{
    margin-top:22px;
    font-size:11.5px;
    color:#8FA093;
  }

  /* ---------- APP SHELL ---------- */
  #view-app{ display:none; width:100%; }
  #view-app.active{ display:flex; }
  .app-shell{
    width:100%;
    display:flex;
    flex-direction:column;
    min-height:100vh;
  }

  .sidebar{
    display:none;
    background:var(--green-dark);
    color:#EDEAE0;
    padding:28px 20px;
    flex-direction:column;
    gap:32px;
  }
  .brand-mark{
    font-family:'Lora', serif;
    font-style:italic;
    font-weight:500;
    font-size:20px;
    color:var(--gold-soft);
  }
  .brand-sub{ font-size:12px; color:#A9B8AE; margin-top:2px; }
  .sidebar nav{ display:flex; flex-direction:column; gap:3px; }
  .sidebar .nav-btn{
    justify-content:flex-start;
    flex-direction:row;
    gap:10px;
    padding:10px 12px;
    border-radius:5px;
    border-left:2px solid transparent;
    background:none;
    color:#CBD6CC;
    font-size:13.5px;
    cursor:pointer;
    border-top:none; border-right:none; border-bottom:none;
  }
  .sidebar .nav-btn:hover{ background:rgba(255,255,255,0.05); color:#fff; }
  .sidebar .nav-btn.active{
    background:rgba(255,255,255,0.07);
    color:#fff;
    border-left:2px solid var(--gold-soft);
  }
  .sidebar .nav-btn .dot{ width:5px; height:5px; opacity:.55; }
  .sidebar-foot{
    margin-top:auto;
    padding-top:18px;
    border-top:1px solid rgba(255,255,255,0.1);
    font-size:11.5px;
    color:#8FA093;
    line-height:1.5;
  }

  .main-col{ flex:1; display:flex; flex-direction:column; min-width:0; }

  .topbar{
    background:var(--green-dark);
    padding:16px 20px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    flex-shrink:0;
  }
  .topbar .who{ color:#fff; }
  .topbar .who .hi{ font-size:11.5px; color:#A9B8AE; }
  .topbar .who .name{ font-family:'Lora', serif; font-size:15px; font-weight:600; margin-top:1px; }
  .avatar{
    width:34px; height:34px; border-radius:50%;
    background:var(--gold-soft); color:var(--green-dark);
    display:flex; align-items:center; justify-content:center;
    font-family:'JetBrains Mono', monospace; font-size:12px; font-weight:600;
    flex-shrink:0; cursor:pointer;
  }

  .main-content{
    flex:1;
    padding:20px 20px 90px;
    width:100%;
    max-width:760px;
    margin:0 auto;
  }
  .page{ display:none; }
  .page.active{ display:block; }

  .bottom-nav{
    background:var(--green-dark);
    display:flex;
    justify-content:space-around;
    align-items:center;
    padding:10px 10px 14px;
    position:fixed;
    left:0; right:0; bottom:0;
    z-index:10;
  }
  .nav-btn{
    display:flex; flex-direction:column; align-items:center; gap:5px;
    background:none; border:none; cursor:pointer;
    color:#8FA093; font-size:10.5px;
  }
  .nav-btn .dot{ width:9px; height:9px; border-radius:50%; background:currentColor; opacity:.5; }
  .nav-btn.active{ color:var(--gold-soft); }
  .nav-btn.active .dot{ background:var(--gold-soft); opacity:1; }

  /* ---------- DASHBOARD PAGE ---------- */
  .banner{
    background:var(--green-badge);
    border-radius:10px;
    padding:14px 16px;
    font-size:12.5px;
    color:var(--green-mid);
    margin-bottom:18px;
    line-height:1.5;
  }
  .cards-row{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(150px, 1fr));
    gap:12px;
    margin-bottom:20px;
  }
  .stat-card{
    background:#fff;
    border:1px solid var(--paper-line-strong);
    border-radius:10px;
    padding:16px;
  }
  .stat-card .label{ font-size:11.5px; color:var(--ink-soft); margin-bottom:6px; }
  .stat-card .value{ font-family:'JetBrains Mono', monospace; font-size:17px; font-weight:500; color:var(--green-dark); }

  .icon-row{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(90px, 1fr));
    gap:10px;
    margin-bottom:24px;
  }
  .icon-btn{
    background:#fff;
    border:1px solid var(--paper-line-strong);
    border-radius:9px;
    cursor:pointer;
    display:flex; flex-direction:column; align-items:center; gap:8px;
    padding:14px 8px;
    font-size:11px;
    color:var(--ink);
  }
  .icon-btn:hover{ border-color:var(--green-mid); }
  .icon-btn .icon-box{
    width:36px; height:36px; border-radius:8px;
    background:var(--green-badge); color:var(--green-mid);
    display:flex; align-items:center; justify-content:center;
    font-family:'Lora', serif; font-size:15px;
  }

  .section-title{ font-family:'Lora', serif; font-size:15px; font-weight:600; margin-bottom:10px; }
  .mini-ledger{ border-top:1px solid var(--paper-line-strong); }
  .mini-row{
    display:flex; justify-content:space-between; align-items:baseline;
    padding:12px 0; border-bottom:1px solid var(--paper-line); font-size:13px;
  }
  .mini-row .desc .cat{ display:block; font-size:11px; color:var(--ink-soft); margin-top:2px; }
  .mini-row .amt{ font-family:'JetBrains Mono', monospace; font-size:13px; white-space:nowrap; }
  .amt.in{ color:var(--green-mid); }
  .amt.out{ color:var(--red-ink); }

  /* ---------- RIWAYAT PAGE ---------- */
  .list-header{
    background:var(--green-badge);
    border-radius:10px;
    padding:13px 16px;
    display:flex; justify-content:space-between; align-items:center;
    margin-bottom:16px;
  }
  .list-header .t{ font-family:'Lora', serif; font-weight:600; font-size:14px; color:var(--green-dark); }
  .list-header .filter{
    font-family:'JetBrains Mono', monospace; font-size:10.5px; color:var(--green-mid);
    background:#fff; padding:4px 9px; border-radius:5px;
  }
  .riwayat-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));
    gap:12px;
  }
  .list-item{
    background:#fff; border:1px solid var(--paper-line-strong); border-radius:10px; padding:14px 15px;
  }
  .list-item .row-top{ display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px; gap:8px; }
  .list-item .title{ font-size:13.5px; font-weight:500; }
  .chip{
    font-size:10px; font-family:'JetBrains Mono', monospace; padding:3px 8px; border-radius:4px;
    background:var(--green-badge); color:var(--green-mid); white-space:nowrap;
  }
  .chip.out{ background:var(--red-ink-soft); color:var(--red-ink); }
  .list-item hr{ border:none; border-top:1px solid var(--paper-line); margin-bottom:9px; }
  .list-item .row-bottom{ display:flex; justify-content:space-between; font-size:11.5px; color:var(--ink-soft); }
  .list-item .row-bottom .amt{ font-family:'JetBrains Mono', monospace; font-weight:500; }

  /* ---------- TAMBAH PAGE ---------- */
  .form-wrap{ max-width:480px; }
  .form-section{ background:var(--green-badge); border-radius:10px; padding:14px; margin-bottom:14px; }
  .form-row{ display:grid; grid-template-columns:1fr 1fr; gap:10px; }
  .field-sm label{ display:block; font-size:10.5px; color:var(--green-mid); margin-bottom:5px; }
  .field-sm select, .field-sm input{
    width:100%; padding:9px 10px; border-radius:6px; border:1px solid var(--paper-line-strong);
    font-size:12.5px; background:#fff; color:var(--ink);
  }
  .form-note-box{ background:#fff; border:1px solid var(--paper-line-strong); border-radius:10px; padding:16px; margin-bottom:16px; }
  .form-note-box label{ display:block; font-size:11px; color:var(--ink-soft); margin-bottom:6px; }
  .form-note-box textarea{
    width:100%; border:none; resize:none; font-size:13px; color:var(--ink); height:70px; margin-bottom:14px;
  }
  .form-note-box textarea:focus{ outline:none; }
  .amount-line{ display:flex; align-items:baseline; gap:8px; border-top:1px dashed var(--paper-line-strong); padding-top:12px; }
  .amount-line label{ font-size:11px; color:var(--ink-soft); margin:0; }
  .amount-line input{
    border:none; font-family:'JetBrains Mono', monospace; font-size:17px; color:var(--green-dark); flex:1; text-align:right;
  }
  .amount-line input:focus{ outline:none; }
  .form-msg{ font-size:11.5px; color:var(--red-ink); min-height:16px; margin-bottom:8px; }

  /* ---------- RESPONSIVE ---------- */
  @media (min-width: 900px){
    .app-shell{ flex-direction:row; }
    .sidebar{ display:flex; width:240px; flex-shrink:0; }
    .bottom-nav{ display:none; }
    .main-content{ padding:36px 40px 40px; max-width:820px; }
    .topbar{ padding:20px 40px; }
  }
</style>
</head>
<body>

<!-- LOGIN -->
<div class="view active" id="view-login">
  <div class="login-wrap">
    <div class="login-title">Aplikasi Pengelolaan<br>Kas Kelas</div>
    <div class="login-card">
      <h2>Masuk</h2>
      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="contoh: admin@kasify.test" required autofocus>
        @error('email')
          <div class="login-error">{{ $message }}</div>
        @enderror

        <label for="password">Kata sandi</label>
        <input id="password" type="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
        @error('password')
          <div class="login-error">{{ $message }}</div>
        @enderror

        <button class="btn-primary" type="submit">Masuk</button>
      </form>
    </div>
    <div class="login-hint">Bendahara: Amanda Eka &middot; XII RPL 1</div>
  </div>
</div>

<!-- APP -->
<div class="view" id="view-app">
  <div class="app-shell">
    <aside class="sidebar">
      <div>
        <div class="brand-mark">Kas Kelas</div>
        <div class="brand-sub">XII &middot; RPL 1</div>
      </div>
      <nav>
        <button class="nav-btn active" data-page="dashboard"><span class="dot"></span>Beranda</button>
        <button class="nav-btn" data-page="riwayat"><span class="dot"></span>Riwayat</button>
        <button class="nav-btn" data-page="tambah"><span class="dot"></span>Tambah transaksi</button>
      </nav>
      <div class="sidebar-foot">Dikelola bersama oleh bendahara kelas &mdash; diperbarui otomatis tiap ada transaksi baru.</div>
    </aside>

    <div class="main-col">
      <div class="topbar">
        <div class="who">
          <div class="hi" id="topTitle">Beranda</div>
          <div class="name">Amanda Eka</div>
        </div>
        <div class="avatar">AE</div>
      </div>

      <div class="main-content">

        <!-- DASHBOARD -->
        <section class="page active" id="page-dashboard">
          <div class="banner">Kas kelas <b>XII RPL 1</b> &mdash; iuran mingguan Rp 10.000/anggota, jatuh tempo tiap Jumat.</div>
          <div class="cards-row">
            <div class="stat-card"><div class="label">Saldo kas</div><div class="value" id="dashSaldo">Rp 2.450.000</div></div>
            <div class="stat-card"><div class="label">Iuran lunas bulan ini</div><div class="value">18/24</div></div>
            <div class="stat-card"><div class="label">Pengeluaran bulan ini</div><div class="value">Rp 95.000</div></div>
          </div>
          <div class="icon-row">
            <button class="icon-btn" data-page="tambah"><span class="icon-box">+</span>Tambah</button>
            <button class="icon-btn" data-page="riwayat"><span class="icon-box">&#8801;</span>Riwayat</button>
            <button class="icon-btn"><span class="icon-box">&#128101;</span>Anggota</button>
            <button class="icon-btn"><span class="icon-box">&#128202;</span>Laporan</button>
          </div>
          <div class="section-title">Transaksi terbaru</div>
          <div class="mini-ledger" id="dashLedger"></div>
        </section>

        <!-- RIWAYAT -->
        <section class="page" id="page-riwayat">
          <div class="list-header">
            <div class="t">September 2026</div>
            <div class="filter">Semua</div>
          </div>
          <div class="riwayat-grid" id="riwayatList"></div>
        </section>

        <!-- TAMBAH -->
        <section class="page" id="page-tambah">
          <div class="form-wrap">
            <div class="form-section">
              <div class="form-row">
                <div class="field-sm">
                  <label>Jenis</label>
                  <select id="fJenis">
                    <option value="in">Pemasukan</option>
                    <option value="out">Pengeluaran</option>
                  </select>
                </div>
                <div class="field-sm">
                  <label>Tanggal</label>
                  <input type="date" id="fTanggal">
                </div>
              </div>
            </div>
            <div class="form-note-box">
              <label>Keterangan</label>
              <textarea id="fKeterangan" placeholder="Misal: Iuran mingguan minggu ke-3"></textarea>
              <div class="amount-line">
                <label>Rp</label>
                <input type="number" id="fJumlah" placeholder="0">
              </div>
            </div>
            <div class="form-msg" id="formMsg"></div>
            <button class="btn-primary" id="btnSimpan">Simpan transaksi</button>
          </div>
        </section>

      </div>

      <div class="bottom-nav">
        <button class="nav-btn active" data-page="dashboard"><span class="dot"></span>Beranda</button>
        <button class="nav-btn" data-page="riwayat"><span class="dot"></span>Riwayat</button>
        <button class="nav-btn" data-page="tambah"><span class="dot"></span>Tambah</button>
      </div>
    </div>
  </div>
</div>

<script>
  let saldo = 2450000;
  let transaksi = [
    { desc:'Iuran mingguan', cat:'Iuran anggota', date:'3 Sep', type:'in', amount:90000 },
    { desc:'Beli spidol & penghapus', cat:'Perlengkapan kelas', date:'1 Sep', type:'out', amount:35000 },
    { desc:'Iuran mingguan', cat:'Iuran anggota', date:'28 Agu', type:'in', amount:120000 },
    { desc:'Sumbangan acara 17-an', cat:'Kas keluar', date:'20 Agu', type:'out', amount:60000 },
  ];

  const pageTitles = { dashboard:'Beranda', riwayat:'Riwayat', tambah:'Tambah transaksi' };
  function fmt(n){ return 'Rp ' + n.toLocaleString('id-ID'); }

  function switchPage(name){
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById('page-' + name).classList.add('active');
    document.querySelectorAll('.nav-btn').forEach(b => b.classList.toggle('active', b.dataset.page === name));
    document.getElementById('topTitle').textContent = pageTitles[name];
    if(name === 'dashboard') renderDashboard();
    if(name === 'riwayat') renderRiwayat();
  }

  document.querySelectorAll('[data-page]').forEach(el => {
    el.addEventListener('click', () => switchPage(el.dataset.page));
  });

  function renderDashboard(){
    document.getElementById('dashSaldo').textContent = fmt(saldo);
    document.getElementById('dashLedger').innerHTML = transaksi.slice(0,4).map(t => `
      <div class="mini-row">
        <div class="desc">${t.desc}<span class="cat">${t.cat}</span></div>
        <div class="amt ${t.type}">${t.type === 'in' ? '+' : '&minus;'}${t.amount.toLocaleString('id-ID')}</div>
      </div>
    `).join('');
  }

  function renderRiwayat(){
    document.getElementById('riwayatList').innerHTML = transaksi.map(t => `
      <div class="list-item">
        <div class="row-top">
          <div class="title">${t.desc}</div>
          <div class="chip ${t.type === 'out' ? 'out' : ''}">${t.cat}</div>
        </div>
        <hr>
        <div class="row-bottom"><div>${t.date}</div><div class="amt">${t.type === 'in' ? '+' : '&minus;'}${fmt(t.amount)}</div></div>
      </div>
    `).join('');
  }

  document.getElementById('btnSimpan').addEventListener('click', () => {
    const jenis = document.getElementById('fJenis').value;
    const tanggal = document.getElementById('fTanggal').value;
    const ket = document.getElementById('fKeterangan').value.trim();
    const jumlah = parseInt(document.getElementById('fJumlah').value, 10);
    const msg = document.getElementById('formMsg');
    if(!ket || !jumlah){ msg.textContent = 'Lengkapi keterangan dan jumlah dulu ya.'; return; }
    msg.textContent = '';
    const dateLabel = tanggal
      ? new Date(tanggal).toLocaleDateString('id-ID', {day:'numeric', month:'short'})
      : new Date().toLocaleDateString('id-ID', {day:'numeric', month:'short'});
    transaksi.unshift({ desc:ket, cat: jenis === 'in' ? 'Pemasukan manual' : 'Pengeluaran manual', date:dateLabel, type:jenis, amount:jumlah });
    saldo = jenis === 'in' ? saldo + jumlah : saldo - jumlah;
    document.getElementById('fKeterangan').value = '';
    document.getElementById('fJumlah').value = '';
    document.getElementById('fTanggal').value = '';
    switchPage('dashboard');
  });

  renderDashboard();
  renderRiwayat();
</script>

</body>
</html>
