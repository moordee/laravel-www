<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
      Layout ini adalah shell aplikasi utama Kasify.
      Semua halaman yang sudah diproteksi oleh middleware auth memakai layout ini
      agar sidebar, topbar, dan gaya visual tetap konsisten di seluruh fitur.
    --}}
    <title>@yield('title', 'Kas Kelas')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;1,500&family=IBM+Plex+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
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

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family:'IBM Plex Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
        }
        a { text-decoration: none; }
        button, input, select, textarea { font-family:inherit; }

        .app-shell {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            background: var(--green-dark);
            color: #EDEAE0;
            padding: 28px 20px;
            gap: 32px;
        }

        .brand-mark {
            font-family:'Lora', serif;
            font-style:italic;
            font-weight:500;
            font-size:20px;
            color:var(--gold-soft);
        }
        .brand-sub { font-size:12px; color:#A9B8AE; margin-top:2px; }

        .sidebar nav {
            display:flex;
            flex-direction:column;
            gap:3px;
        }
        .nav-btn {
            display:flex;
            align-items:center;
            gap:10px;
            padding:10px 12px;
            border-radius:5px;
            background:none;
            color:#CBD6CC;
            font-size:13.5px;
            border-left:2px solid transparent;
        }
        .nav-btn:hover { background:rgba(255,255,255,0.05); color:#fff; }
        .nav-btn.active {
            background:rgba(255,255,255,0.07);
            color:#fff;
            border-left:2px solid var(--gold-soft);
        }
        .nav-btn .dot {
            width:5px; height:5px; border-radius: 50%; background: currentColor; display:inline-block; opacity:0.6;
        }

        .sidebar-foot {
            margin-top:auto;
            padding-top:18px;
            border-top:1px solid rgba(255,255,255,0.1);
            font-size:11.5px;
            color:#8FA093;
            line-height:1.5;
        }

        .main-col { flex:1; display:flex; flex-direction:column; min-width:0; }

        .topbar {
            background:var(--green-dark);
            padding:16px 20px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            flex-shrink:0;
        }
        .topbar .who { color:#fff; }
        .topbar .hi { font-size:11.5px; color:#A9B8AE; }
        .topbar .name {
            font-family:'Lora', serif;
            font-size:15px;
            font-weight:600;
            margin-top:1px;
        }
        .avatar {
            width:34px; height:34px; border-radius:50%;
            background:var(--gold-soft); color:var(--green-dark);
            display:flex; align-items:center; justify-content:center;
            font-family:'JetBrains Mono', monospace; font-size:12px; font-weight:600;
        }

        .main-content {
            flex:1;
            padding:20px 20px 90px;
            width:100%;
            max-width:760px;
            margin:0 auto;
        }

        .list-header,
        .cards-row,
        .trend-legend,
        .section-title,
        .table-wrap,
        .modal-card,
        .member-list,
        .member-row {
            box-sizing: border-box;
        }

        .list-header {
            background: var(--green-badge);
            border-radius: 10px;
            padding: 13px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .list-header .t {
            font-family:'Lora', serif;
            font-weight:600;
            font-size:14px;
            color:var(--green-dark);
        }
        .list-header .filter {
            font-family:'JetBrains Mono', monospace;
            font-size:10.5px;
            color:var(--green-mid);
            background:#fff;
            padding:4px 9px;
            border-radius:5px;
        }

        .cards-row {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(150px, 1fr));
            gap:12px;
            margin-bottom:20px;
        }
        .stat-card {
            background:#fff;
            border:1px solid var(--paper-line-strong);
            border-radius:10px;
            padding:16px;
        }
        .stat-card .label { font-size:11.5px; color:var(--ink-soft); margin-bottom:6px; }
        .stat-card .value {
            font-family:'JetBrains Mono', monospace;
            font-size:17px;
            font-weight:500;
            color:var(--green-dark);
        }
        .value.in-value { color: var(--green-mid); }
        .value.out-value { color: var(--red-ink); }

        .section-title {
            font-family:'Lora', serif;
            font-size:15px;
            font-weight:600;
            margin: 18px 0 10px;
        }

        .trend-chart {
            display:flex;
            align-items:flex-end;
            gap:12px;
            height:120px;
            padding:18px 10px 8px;
            background:#fff;
            border:1px solid var(--paper-line-strong);
            border-radius:10px;
        }
        .trend-col { flex:1; display:flex; flex-direction:column; align-items:center; gap:8px; }
        .trend-bars {
            display:flex; align-items:flex-end; justify-content:center; gap:6px;
            width:100%; height:90px;
        }
        .trend-bar {
            width:22%; min-width: 12px; border-radius:6px 6px 0 0;
        }
        .trend-bar.in { background: var(--green-mid); }
        .trend-bar.out { background: var(--red-ink); }
        .trend-label { font-size:10.5px; color:var(--ink-soft); }

        .trend-legend {
            display:flex; gap:16px; align-items:center; justify-content:flex-end;
            margin:10px 0 20px; font-size:11px; color:var(--ink-soft);
        }
        .legend-dot {
            display:inline-block; width:9px; height:9px; border-radius:50%; margin-right:6px;
        }
        .legend-dot.in { background: var(--green-mid); }
        .legend-dot.out { background: var(--red-ink); }

        .category-row {
            background:#fff;
            border:1px solid var(--paper-line-strong);
            border-radius:10px;
            padding:12px 14px;
            margin-bottom:10px;
        }
        .cat-top {
            display:flex; justify-content:space-between; align-items:center;
            font-size:12px; margin-bottom:8px;
        }
        .bar-track {
            width:100%; height:8px; border-radius:999px;
            background: var(--green-badge); overflow:hidden;
        }
        .bar-fill { height:100%; border-radius:999px; }
        .bar-fill.in { background: var(--green-mid); }
        .bar-fill.out { background: var(--red-ink); }
        .amt { font-family:'JetBrains Mono', monospace; }
        .amt.in { color: var(--green-mid); }
        .amt.out { color: var(--red-ink); }

        .table-wrap {
            overflow-x:auto;
            background:#fff;
            border:1px solid var(--paper-line-strong);
            border-radius:10px;
        }
        .report-table {
            width:100%; border-collapse:collapse; min-width:560px;
        }
        .report-table th, .report-table td {
            padding:10px 12px; border-bottom:1px solid var(--paper-line); text-align:left; font-size:12px;
        }
        .report-table th {
            background:#F4F0E5; color:var(--green-dark); font-size:11px; letter-spacing:0.03em;
        }
        .report-table .text-right { text-align:right; }
        .date { color: var(--ink-soft); }
        .actions-cell { width: 110px; }
        .row-actions, .row-confirm { display:flex; align-items:center; gap:8px; }
        .icon-action {
            border:none; border-radius:6px; background:var(--green-badge); color:var(--green-mid);
            width:28px; height:28px; cursor:pointer; font-size:14px;
        }
        .icon-action.danger { background: var(--red-ink-soft); color: var(--red-ink); }

        .btn-small,
        .btn-ghost,
        .yes,
        .no {
            border:none; border-radius:6px; cursor:pointer; font-weight:600;
        }
        .btn-small {
            background: var(--gold); color: var(--green-dark); padding:8px 12px; font-size:12px;
        }
        .btn-ghost {
            background: transparent; border:1px solid var(--paper-line-strong); color: var(--ink); padding:8px 12px; font-size:12px;
        }
        .yes { background:var(--green-badge); color:var(--green-mid); padding:6px 10px; }
        .no { background:var(--red-ink-soft); color:var(--red-ink); padding:6px 10px; }

        .modal-backdrop {
            position:fixed; inset:0; background: rgba(17, 24, 18, 0.45); display:none; align-items:center; justify-content:center; padding:20px; z-index:100;
        }
        .modal-backdrop.open { display:flex; }
        .modal-card {
            width:min(100%, 480px); background:#fff; border:1px solid var(--paper-line-strong); border-radius:12px; padding:20px; box-shadow: 0 18px 40px rgba(0,0,0,0.14);
        }
        .modal-card h3 {
            margin:0 0 18px; font-family:'Lora', serif; color:var(--green-dark);
        }
        .field { margin-bottom:14px; }
        .field-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .field label { display:block; font-size:11px; color:var(--ink-soft); margin-bottom:6px; }
        .field input, .field select {
            width:100%; padding:9px 10px; border-radius:6px; border:1px solid var(--paper-line-strong); font-size:12.5px; background:#fff; color:var(--ink);
        }
        .modal-actions { display:flex; justify-content:flex-end; gap:10px; margin-top:18px; }
        .form-msg { font-size:11.5px; color:var(--red-ink); min-height:16px; margin: 6px 0 10px; }

        .member-list { display:flex; flex-direction:column; gap:10px; }
        .member-row {
            display:grid; grid-template-columns: minmax(0,1fr) auto auto; gap:12px; align-items:center;
            background:#fff; border:1px solid var(--paper-line-strong); border-radius:10px; padding:12px 14px;
        }
        .member-name {
            display:flex; align-items:center; gap:10px; font-size:13px; font-weight:500; color:var(--ink);
        }
        .member-initial {
            width:30px; height:30px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center;
            background:var(--green-badge); color:var(--green-mid); font-size:11px; font-family:'JetBrains Mono', monospace;
        }
        .status-pill {
            border:none; border-radius:999px; padding:6px 10px; font-size:11px; font-weight:600; cursor:pointer;
        }
        .status-pill.paid { background: var(--green-badge); color: var(--green-mid); }
        .status-pill.unpaid { background: var(--red-ink-soft); color: var(--red-ink); }
        .member-actions { display:flex; gap:8px; }
        .member-hint { margin-top:16px; font-size:11.5px; color:var(--ink-soft); }
        .confirm-inline { display:flex; align-items:center; justify-content:flex-end; gap:8px; font-size:11.5px; color:var(--ink-soft); }

        @media (min-width: 900px) {
            .app-shell { flex-direction: row; }
            .sidebar { width: 240px; flex-shrink:0; }
            .main-content { padding:36px 40px 40px; max-width:820px; }
            .topbar { padding:20px 40px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{--
      Di sini struktur utama aplikasi dirender: sidebar sebagai navigasi,
      main-col sebagai area konten, dan topbar sebagai header umum.
      Semua halaman child cukup menyiapkan content dan nilai heading,
      sementara layout ini menjaga tampilan serta navigasi tetap konsisten.
    --}}
    <div class="app-shell">
        <aside class="sidebar">
            <div>
                <div class="brand-mark">Kas Kelas</div>
                <div class="brand-sub">XII &middot; RPL 1</div>
            </div>
            <nav>
                <a href="{{ route('beranda') }}" class="nav-btn {{ request()->routeIs('beranda') ? 'active' : '' }}"><span class="dot"></span>Beranda</a>
                <a href="{{ route('riwayat') }}" class="nav-btn {{ request()->routeIs('riwayat') ? 'active' : '' }}"><span class="dot"></span>Riwayat</a>
                <a href="{{ route('transaksi') }}" class="nav-btn {{ request()->routeIs('transaksi') ? 'active' : '' }}"><span class="dot"></span>Tambah transaksi</a>
                <a href="{{ route('anggota') }}" class="nav-btn {{ request()->routeIs('anggota') ? 'active' : '' }}"><span class="dot"></span>Anggota</a>
                <a href="{{ route('laporan') }}" class="nav-btn {{ request()->routeIs('laporan') ? 'active' : '' }}"><span class="dot"></span>Laporan</a>
            </nav>
            <div class="sidebar-foot">Dikelola bersama oleh bendahara kelas &mdash; diperbarui otomatis tiap ada transaksi baru.</div>
        </aside>

        <div class="main-col">
            <div class="topbar">
                <div class="who">
                    <div class="hi">@yield('pageHeading', 'Kas Kelas')</div>
                    <div class="name">Amanda Eka</div>
                </div>
                <div class="avatar">AE</div>
            </div>

            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
