<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Kas Kelas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;1,500&family=IBM+Plex+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green-dark: #1F3B33;
            --green-mid: #2F6F4F;
            --green-badge: #DCE9DE;
            --paper: #FBF7EE;
            --paper-line: #E4DFCF;
            --paper-line-strong: #D6CFB8;
            --ink: #26241D;
            --ink-soft: #6B6656;
            --gold: #C9A227;
            --gold-soft: #E6C766;
            --red-ink: #A63D40;
            --red-ink-soft: #F1DEDD;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'IBM Plex Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        .view {
            display: none;
            min-height: 100vh;
        }

        .view.active {
            display: flex;
        }

        /* ---------- LOGIN ---------- */
        #view-login {
            background: var(--green-dark);
            background-image: radial-gradient(circle at 15% 8%, #274A40 0%, var(--green-dark) 55%);
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-wrap {
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .login-title {
            font-family: 'Lora', serif;
            font-weight: 600;
            font-style: italic;
            font-size: 21px;
            line-height: 1.5;
            color: #EDEAE0;
            margin-bottom: 44px;
        }

        .login-card {
            background: #16281F;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 14px;
            padding: 28px 24px 24px;
            text-align: left;
        }

        .login-card h2 {
            font-family: 'Lora', serif;
            color: var(--gold-soft);
            font-size: 16px;
            text-align: center;
            margin-bottom: 22px;
            font-weight: 600;
        }

        .login-card label {
            display: block;
            font-size: 11.5px;
            color: #A9B8AE;
            margin-bottom: 6px;
        }

        .login-card input {
            width: 100%;
            padding: 12px 13px;
            border-radius: 6px;
            border: none;
            font-size: 13.5px;
            margin-bottom: 16px;
            background: #fff;
            color: var(--ink);
        }

        .login-card input:last-of-type {
            margin-bottom: 4px;
        }

        .login-error {
            font-size: 11.5px;
            color: #E8A5A5;
            min-height: 16px;
            margin-bottom: 4px;
        }

        .btn-primary {
            width: 100%;
            background: var(--gold);
            color: var(--green-dark);
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 14px;
            transition: background .15s ease;
        }

        .btn-primary:hover {
            background: var(--gold-soft);
        }

        .login-hint {
            margin-top: 22px;
            font-size: 11.5px;
            color: #8FA093;
        }

        /* ---------- APP SHELL ---------- */
        #view-app {
            display: none;
            width: 100%;
        }

        #view-app.active {
            display: flex;
        }

        .app-shell {
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            display: none;
            background: var(--green-dark);
            color: #EDEAE0;
            padding: 28px 20px;
            flex-direction: column;
            gap: 28px;
        }

        .brand-mark {
            font-family: 'Lora', serif;
            font-style: italic;
            font-weight: 500;
            font-size: 20px;
            color: var(--gold-soft);
        }

        .brand-sub {
            font-size: 12px;
            color: #A9B8AE;
            margin-top: 2px;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar .nav-btn {
            justify-content: flex-start;
            flex-direction: row;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 5px;
            border-left: 2px solid transparent;
            background: none;
            color: #CBD6CC;
            font-size: 13.5px;
            cursor: pointer;
            border-top: none;
            border-right: none;
            border-bottom: none;
        }

        .sidebar .nav-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .sidebar .nav-btn.active {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
            border-left: 2px solid var(--gold-soft);
        }

        .sidebar .nav-btn .dot {
            width: 5px;
            height: 5px;
            opacity: .55;
        }

        .sidebar-foot {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 11.5px;
            color: #8FA093;
            line-height: 1.5;
        }

        .main-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .topbar {
            background: var(--green-dark);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .topbar .who {
            color: #fff;
        }

        .topbar .who .hi {
            font-size: 11.5px;
            color: #A9B8AE;
        }

        .topbar .who .name {
            font-family: 'Lora', serif;
            font-size: 15px;
            font-weight: 600;
            margin-top: 1px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--gold-soft);
            color: var(--green-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            flex-shrink: 0;
            cursor: pointer;
        }

        .main-content {
            flex: 1;
            padding: 20px 20px 90px;
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        .bottom-nav {
            background: var(--green-dark);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 10px 14px;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
        }

        .nav-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            color: #8FA093;
            font-size: 10.5px;
        }

        .nav-btn .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: currentColor;
            opacity: .5;
        }

        .nav-btn.active {
            color: var(--gold-soft);
        }

        .nav-btn.active .dot {
            background: var(--gold-soft);
            opacity: 1;
        }

        /* ---------- SHARED PAGE PARTS ---------- */
        .banner {
            background: var(--green-badge);
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 12.5px;
            color: var(--green-mid);
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .cards-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--paper-line-strong);
            border-radius: 10px;
            padding: 16px;
        }

        .stat-card .label {
            font-size: 11.5px;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }

        .stat-card .value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 17px;
            font-weight: 500;
            color: var(--green-dark);
        }

        .stat-card .value.in-value {
            color: var(--green-mid);
        }

        .stat-card .value.out-value {
            color: var(--red-ink);
        }

        .icon-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
            gap: 10px;
            margin-bottom: 24px;
        }

        .icon-btn {
            background: #fff;
            border: 1px solid var(--paper-line-strong);
            border-radius: 9px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 14px 8px;
            font-size: 11px;
            color: var(--ink);
        }

        .icon-btn:hover {
            border-color: var(--green-mid);
        }

        .icon-btn .icon-box {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--green-badge);
            color: var(--green-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Lora', serif;
            font-size: 15px;
        }

        .section-title {
            font-family: 'Lora', serif;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .mini-ledger {
            border-top: 1px solid var(--paper-line-strong);
        }

        .mini-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 12px 0;
            border-bottom: 1px solid var(--paper-line);
            font-size: 13px;
        }

        .mini-row .desc .cat {
            display: block;
            font-size: 11px;
            color: var(--ink-soft);
            margin-top: 2px;
        }

        .mini-row .amt {
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            white-space: nowrap;
        }

        .amt.in {
            color: var(--green-mid);
        }

        .amt.out {
            color: var(--red-ink);
        }

        .list-header {
            background: var(--green-badge);
            border-radius: 10px;
            padding: 13px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .list-header .t {
            font-family: 'Lora', serif;
            font-weight: 600;
            font-size: 14px;
            color: var(--green-dark);
        }

        .list-header .filter {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10.5px;
            color: var(--green-mid);
            background: #fff;
            padding: 4px 9px;
            border-radius: 5px;
        }

        .btn-small {
            background: var(--green-dark);
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-small:hover {
            background: #16281F;
        }

        /* ---------- RIWAYAT ---------- */
        .riwayat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }

        .list-item {
            background: #fff;
            border: 1px solid var(--paper-line-strong);
            border-radius: 10px;
            padding: 14px 15px;
        }

        .list-item .row-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            gap: 8px;
        }

        .list-item .title {
            font-size: 13.5px;
            font-weight: 500;
        }

        .chip {
            font-size: 10px;
            font-family: 'JetBrains Mono', monospace;
            padding: 3px 8px;
            border-radius: 4px;
            background: var(--green-badge);
            color: var(--green-mid);
            white-space: nowrap;
        }

        .chip.out {
            background: var(--red-ink-soft);
            color: var(--red-ink);
        }

        .list-item hr {
            border: none;
            border-top: 1px solid var(--paper-line);
            margin-bottom: 9px;
        }

        .list-item .row-bottom {
            display: flex;
            justify-content: space-between;
            font-size: 11.5px;
            color: var(--ink-soft);
        }

        .list-item .row-bottom .amt {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 500;
        }

        /* ---------- TAMBAH ---------- */
        .form-wrap {
            max-width: 480px;
        }

        .form-section {
            background: var(--green-badge);
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .field-sm label {
            display: block;
            font-size: 10.5px;
            color: var(--green-mid);
            margin-bottom: 5px;
        }

        .field-sm select,
        .field-sm input {
            width: 100%;
            padding: 9px 10px;
            border-radius: 6px;
            border: 1px solid var(--paper-line-strong);
            font-size: 12.5px;
            background: #fff;
            color: var(--ink);
        }

        .form-note-box {
            background: #fff;
            border: 1px solid var(--paper-line-strong);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .form-note-box label {
            display: block;
            font-size: 11px;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }

        .form-note-box textarea {
            width: 100%;
            border: none;
            resize: none;
            font-size: 13px;
            color: var(--ink);
            height: 70px;
            margin-bottom: 14px;
        }

        .form-note-box textarea:focus {
            outline: none;
        }

        .amount-line {
            display: flex;
            align-items: baseline;
            gap: 8px;
            border-top: 1px dashed var(--paper-line-strong);
            padding-top: 12px;
        }

        .amount-line label {
            font-size: 11px;
            color: var(--ink-soft);
            margin: 0;
        }

        .amount-line input {
            border: none;
            font-family: 'JetBrains Mono', monospace;
            font-size: 17px;
            color: var(--green-dark);
            flex: 1;
            text-align: right;
        }

        .amount-line input:focus {
            outline: none;
        }

        .form-msg {
            font-size: 11.5px;
            color: var(--red-ink);
            min-height: 16px;
            margin-bottom: 8px;
        }

        /* ---------- LAPORAN ---------- */
        .trend-chart {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            height: 140px;
            padding: 0 6px;
            border-bottom: 1px solid var(--paper-line-strong);
            margin-bottom: 10px;
        }

        .trend-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .trend-bars {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 110px;
        }

        .trend-bar {
            width: 11px;
            border-radius: 2px 2px 0 0;
        }

        .trend-bar.in {
            background: var(--green-mid);
        }

        .trend-bar.out {
            background: var(--red-ink);
        }

        .trend-label {
            font-size: 10.5px;
            color: var(--ink-soft);
            font-family: 'JetBrains Mono', monospace;
        }

        .trend-legend {
            display: flex;
            gap: 18px;
            font-size: 11.5px;
            color: var(--ink-soft);
            margin-bottom: 26px;
        }

        .trend-legend span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 2px;
            display: inline-block;
        }

        .legend-dot.in {
            background: var(--green-mid);
        }

        .legend-dot.out {
            background: var(--red-ink);
        }

        .category-row {
            margin-bottom: 16px;
        }

        .cat-top {
            display: flex;
            justify-content: space-between;
            font-size: 12.5px;
            margin-bottom: 6px;
        }

        .cat-top .amt {
            font-family: 'JetBrains Mono', monospace;
        }

        .bar-track {
            height: 6px;
            background: var(--paper-line);
            border-radius: 3px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 3px;
        }

        .bar-fill.in {
            background: var(--green-mid);
        }

        .bar-fill.out {
            background: var(--red-ink);
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--paper-line-strong);
            border-radius: 10px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
            min-width: 560px;
        }

        .report-table thead th {
            text-align: left;
            font-size: 10.5px;
            color: var(--ink-soft);
            font-weight: 500;
            padding: 10px 14px;
            border-bottom: 1px solid var(--paper-line-strong);
            background: var(--green-badge);
            white-space: nowrap;
        }

        .report-table thead th.text-right {
            text-align: right;
        }

        .report-table tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid var(--paper-line);
            vertical-align: middle;
        }

        .report-table tbody tr:last-child td {
            border-bottom: none;
        }

        .report-table td.date {
            font-family: 'JetBrains Mono', monospace;
            color: var(--ink-soft);
            white-space: nowrap;
        }

        .report-table td.amt {
            font-family: 'JetBrains Mono', monospace;
            text-align: right;
            white-space: nowrap;
        }

        .report-table td.actions-cell {
            white-space: nowrap;
            text-align: right;
        }

        .report-table tfoot td {
            padding: 12px 14px;
            font-weight: 600;
            border-top: 1px solid var(--paper-line-strong);
        }

        .report-table tfoot td.amt {
            font-family: 'JetBrains Mono', monospace;
            text-align: right;
        }

        .row-actions {
            display: inline-flex;
            gap: 6px;
        }

        .row-confirm {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            font-size: 11.5px;
            color: var(--red-ink);
            white-space: nowrap;
        }

        .row-confirm button {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 11.5px;
            font-weight: 600;
        }

        .row-confirm .yes {
            color: var(--red-ink);
        }

        .row-confirm .no {
            color: var(--ink-soft);
        }

        /* ---------- ANGGOTA ---------- */
        .member-list {
            border-top: 1px solid var(--paper-line-strong);
        }

        .member-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 2px;
            border-bottom: 1px solid var(--paper-line);
            gap: 10px;
            flex-wrap: wrap;
        }

        .member-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            cursor: pointer;
        }

        .member-initial {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--green-badge);
            color: var(--green-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            flex-shrink: 0;
        }

        .status-pill {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
            font-family: 'JetBrains Mono', monospace;
            cursor: pointer;
            border: none;
        }

        .status-pill.paid {
            background: var(--green-badge);
            color: var(--green-mid);
        }

        .status-pill.unpaid {
            background: var(--red-ink-soft);
            color: var(--red-ink);
        }

        .member-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: auto;
        }

        .icon-action {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid var(--paper-line-strong);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            color: var(--ink-soft);
        }

        .icon-action:hover {
            border-color: var(--green-mid);
            color: var(--green-mid);
        }

        .icon-action.danger:hover {
            border-color: var(--red-ink);
            color: var(--red-ink);
        }

        .member-hint {
            font-size: 11.5px;
            color: var(--ink-soft);
            margin-top: 14px;
        }

        .confirm-inline {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--red-ink);
            margin-left: auto;
        }

        .confirm-inline button {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        .confirm-inline .yes {
            color: var(--red-ink);
        }

        .confirm-inline .no {
            color: var(--ink-soft);
        }

        /* ---------- MODAL ---------- */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(31, 59, 51, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity .18s ease;
            z-index: 50;
            padding: 20px;
        }

        .modal-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            background: var(--paper);
            width: 100%;
            max-width: 380px;
            border-radius: 12px;
            padding: 24px;
            transform: translateY(8px);
            opacity: 0;
            transition: transform .18s ease, opacity .18s ease;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-backdrop.open .modal-card {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-card h3 {
            font-family: 'Lora', serif;
            font-size: 17px;
            color: var(--green-dark);
            margin-bottom: 18px;
        }

        .modal-card .field {
            margin-bottom: 14px;
        }

        .modal-card .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .modal-card label {
            display: block;
            font-size: 11px;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }

        .modal-card input,
        .modal-card select {
            width: 100%;
            padding: 10px 11px;
            border-radius: 6px;
            border: 1px solid var(--paper-line-strong);
            font-size: 13.5px;
            background: #fff;
            color: var(--ink);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 16px;
        }

        .btn-ghost {
            background: none;
            border: none;
            color: var(--ink-soft);
            font-size: 13px;
            cursor: pointer;
            padding: 9px 12px;
        }

        /* ---------- RESPONSIVE ---------- */
        @media (min-width: 900px) {
            .app-shell {
                flex-direction: row;
            }

            .sidebar {
                display: flex;
                width: 240px;
                flex-shrink: 0;
            }

            .bottom-nav {
                display: none;
            }

            .main-content {
                padding: 36px 40px 40px;
                max-width: 900px;
            }

            .topbar {
                padding: 20px 40px;
            }
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
                <label for="loginUser">Email atau NIS</label>
                <input type="text" id="loginUser" placeholder="contoh: 2211-amanda">
                <label for="loginPass">Kata sandi</label>
                <input type="password" id="loginPass" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                <div class="login-error" id="loginError"></div>
                <button class="btn-primary" id="btnLogin">Masuk</button>
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
                    <button class="nav-btn" data-page="anggota"><span class="dot"></span>Anggota</button>
                    <button class="nav-btn" data-page="laporan"><span class="dot"></span>Laporan</button>
                </nav>
                <div class="sidebar-foot">Dikelola bersama oleh bendahara kelas &mdash; diperbarui otomatis tiap ada
                    transaksi baru.</div>
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
                        <div class="banner">Kas kelas <b>XII RPL 1</b> &mdash; iuran mingguan Rp 10.000/anggota, jatuh
                            tempo tiap Jumat.</div>
                        <div class="cards-row">
                            <div class="stat-card">
                                <div class="label">Saldo kas</div>
                                <div class="value" id="dashSaldo">Rp 2.450.000</div>
                            </div>
                            <div class="stat-card">
                                <div class="label">Iuran lunas bulan ini</div>
                                <div class="value" id="dashLunas">&nbsp;</div>
                            </div>
                            <div class="stat-card">
                                <div class="label">Pengeluaran bulan ini</div>
                                <div class="value">Rp 95.000</div>
                            </div>
                        </div>
                        <div class="icon-row">
                            <button class="icon-btn" data-page="tambah"><span class="icon-box">+</span>Tambah</button>
                            <button class="icon-btn" data-page="riwayat"><span
                                    class="icon-box">&#8801;</span>Riwayat</button>
                            <button class="icon-btn" data-page="anggota"><span
                                    class="icon-box">&#128101;</span>Anggota</button>
                            <button class="icon-btn" data-page="laporan"><span
                                    class="icon-box">&#128202;</span>Laporan</button>
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

                    <!-- ANGGOTA -->
                    <section class="page" id="page-anggota">
                        <div class="list-header">
                            <div class="t" id="anggotaFilter">Anggota Kelas</div>
                            <button class="btn-small" id="btnTambahAnggota">+ Tambah anggota</button>
                        </div>
                        <div class="member-list" id="memberList"></div>
                        <div class="member-hint">Klik status untuk menandai Lunas/Belum &middot; pakai ikon di kanan
                            untuk edit atau hapus.</div>
                    </section>

                    <!-- LAPORAN -->
                    <section class="page" id="page-laporan">
                        <div class="list-header">
                            <div class="t">Laporan Keuangan</div>
                            <div class="filter">September 2026</div>
                        </div>

                        <div class="cards-row">
                            <div class="stat-card">
                                <div class="label">Total pemasukan</div>
                                <div class="value in-value" id="lapMasuk">Rp 210.000</div>
                            </div>
                            <div class="stat-card">
                                <div class="label">Total pengeluaran</div>
                                <div class="value out-value" id="lapKeluar">Rp 95.000</div>
                            </div>
                            <div class="stat-card">
                                <div class="label">Saldo akhir</div>
                                <div class="value" id="lapSaldo">Rp 2.450.000</div>
                            </div>
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
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Kategori</th>
                                        <th>Jenis</th>
                                        <th class="text-right">Jumlah</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody"></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Total pemasukan</td>
                                        <td class="amt" id="tfootIn" style="color:var(--green-mid);"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total pengeluaran</td>
                                        <td class="amt" id="tfootOut" style="color:var(--red-ink);"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
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

    <!-- MODAL ANGGOTA -->
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

    <!-- MODAL EDIT TRANSAKSI -->
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
                    <input type="text" id="txnTanggalInput" placeholder="misal: 3 Sep">
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
                <input type="number" id="txnJumlahInput" placeholder="0">
            </div>
            <div class="form-msg" id="txnModalMsg" style="margin-bottom:0;"></div>
            <div class="modal-actions">
                <button class="btn-ghost" id="txnModalCancel">Batal</button>
                <button class="btn-small" id="txnModalSave">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        let saldo = 2450000;
        let transaksi = [{
                desc: 'Iuran mingguan',
                cat: 'Iuran anggota',
                date: '3 Sep',
                type: 'in',
                amount: 90000
            },
            {
                desc: 'Beli spidol & penghapus',
                cat: 'Perlengkapan kelas',
                date: '1 Sep',
                type: 'out',
                amount: 35000
            },
            {
                desc: 'Iuran mingguan',
                cat: 'Iuran anggota',
                date: '28 Agu',
                type: 'in',
                amount: 120000
            },
            {
                desc: 'Sumbangan acara 17-an',
                cat: 'Kas keluar',
                date: '20 Agu',
                type: 'out',
                amount: 60000
            },
        ];

        let anggota = [{
                nama: 'Ahmad Rizky',
                status: 'paid'
            },
            {
                nama: 'Bella Safira',
                status: 'paid'
            },
            {
                nama: 'Citra Wulandari',
                status: 'unpaid'
            },
            {
                nama: 'Dimas Prasetyo',
                status: 'paid'
            },
            {
                nama: 'Evan Saputra',
                status: 'unpaid'
            },
            {
                nama: 'Farah Nabila',
                status: 'paid'
            },
            {
                nama: 'Gilang Ramadhan',
                status: 'paid'
            },
            {
                nama: 'Hana Puspita',
                status: 'unpaid'
            },
        ];

        // data statis untuk grafik tren 4 bulan (contoh, belum terhubung ke histori asli)
        const trendData = [{
                label: 'Jun',
                in: 60,
                out: 25
            },
            {
                label: 'Jul',
                in: 80,
                out: 40
            },
            {
                label: 'Agu',
                in: 65,
                out: 32
            },
            {
                label: 'Sep',
                in: 90,
                out: 35
            },
        ];

        let confirmDeleteIdx = null; // anggota
        let editingIdx = null; // anggota
        let confirmDeleteTxnIdx = null; // transaksi
        let editingTxnIdx = null; // transaksi

        const pageTitles = {
            dashboard: 'Beranda',
            riwayat: 'Riwayat',
            tambah: 'Tambah transaksi',
            anggota: 'Anggota',
            laporan: 'Laporan'
        };

        function fmt(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function initials(name) {
            return name.trim().split(/\s+/).map(w => w[0]).slice(0, 2).join('').toUpperCase();
        }

        function txnContribution(t) {
            return t.type === 'in' ? t.amount : -t.amount;
        }

        function switchPage(name) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.getElementById('page-' + name).classList.add('active');
            document.querySelectorAll('.nav-btn').forEach(b => b.classList.toggle('active', b.dataset.page === name));
            document.getElementById('topTitle').textContent = pageTitles[name];
            if (name === 'dashboard') renderDashboard();
            if (name === 'riwayat') renderRiwayat();
            if (name === 'anggota') {
                confirmDeleteIdx = null;
                renderAnggota();
            }
            if (name === 'laporan') {
                confirmDeleteTxnIdx = null;
                renderLaporan();
            }
        }

        document.querySelectorAll('[data-page]').forEach(el => {
            el.addEventListener('click', () => switchPage(el.dataset.page));
        });

        document.getElementById('btnLogin').addEventListener('click', () => {
            const u = document.getElementById('loginUser').value.trim();
            const p = document.getElementById('loginPass').value.trim();
            const err = document.getElementById('loginError');
            if (!u || !p) {
                err.textContent = 'Isi email/NIS dan kata sandi dulu ya.';
                return;
            }
            err.textContent = '';
            document.getElementById('view-login').classList.remove('active');
            document.getElementById('view-app').classList.add('active');
            switchPage('dashboard');
        });

        function renderDashboard() {
            document.getElementById('dashSaldo').textContent = fmt(saldo);
            const lunas = anggota.filter(a => a.status === 'paid').length;
            document.getElementById('dashLunas').textContent = `${lunas}/${anggota.length}`;
            document.getElementById('dashLedger').innerHTML = transaksi.slice(0, 4).map(t => `
      <div class="mini-row">
        <div class="desc">${t.desc}<span class="cat">${t.cat}</span></div>
        <div class="amt ${t.type}">${t.type === 'in' ? '+' : '&minus;'}${t.amount.toLocaleString('id-ID')}</div>
      </div>
    `).join('');
        }

        function renderRiwayat() {
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

        /* ---------- ANGGOTA: render + CRUD ---------- */
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
                el.addEventListener('click', () => {
                    const idx = parseInt(el.dataset.idx, 10);
                    const action = el.dataset.action;
                    if (action === 'toggle-status') {
                        anggota[idx].status = anggota[idx].status === 'paid' ? 'unpaid' : 'paid';
                        renderAnggota();
                        renderDashboard();
                    } else if (action === 'edit') {
                        openMemberModal(idx);
                    } else if (action === 'delete') {
                        confirmDeleteIdx = idx;
                        renderAnggota();
                    } else if (action === 'confirm-delete') {
                        anggota.splice(idx, 1);
                        confirmDeleteIdx = null;
                        renderAnggota();
                        renderDashboard();
                    } else if (action === 'cancel-delete') {
                        confirmDeleteIdx = null;
                        renderAnggota();
                    }
                });
            });
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
        document.getElementById('memberModalSave').addEventListener('click', () => {
            const nama = document.getElementById('memberNameInput').value.trim();
            const status = document.getElementById('memberStatusInput').value;
            if (!nama) {
                document.getElementById('memberModalMsg').textContent = 'Nama anggota belum diisi.';
                return;
            }
            if (editingIdx !== null) {
                anggota[editingIdx].nama = nama;
                anggota[editingIdx].status = status;
            } else {
                anggota.push({
                    nama,
                    status
                });
            }
            closeMemberModal();
            renderAnggota();
            renderDashboard();
        });

        /* ---------- LAPORAN: render + edit/hapus transaksi dari tabel ---------- */
        function renderLaporan() {
            const totalIn = transaksi.filter(t => t.type === 'in').reduce((s, t) => s + t.amount, 0);
            const totalOut = transaksi.filter(t => t.type === 'out').reduce((s, t) => s + t.amount, 0);
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
                if (!byCat[t.cat]) byCat[t.cat] = {
                    in: 0,
                    out: 0
                };
                byCat[t.cat][t.type] += t.amount;
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
            <td class="date">${t.date}</td>
            <td>${t.desc}</td>
            <td>${t.cat}</td>
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
          <td class="date">${t.date}</td>
          <td>${t.desc}</td>
          <td>${t.cat}</td>
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
                el.addEventListener('click', () => {
                    const idx = parseInt(el.dataset.tidx, 10);
                    const action = el.dataset.taction;
                    if (action === 'edit') {
                        openTxnModal(idx);
                    } else if (action === 'delete') {
                        confirmDeleteTxnIdx = idx;
                        renderLaporan();
                    } else if (action === 'confirm-delete') {
                        saldo -= txnContribution(transaksi[idx]);
                        transaksi.splice(idx, 1);
                        confirmDeleteTxnIdx = null;
                        renderLaporan();
                        renderDashboard();
                        renderRiwayat();
                    } else if (action === 'cancel-delete') {
                        confirmDeleteTxnIdx = null;
                        renderLaporan();
                    }
                });
            });
        }

        function openTxnModal(idx) {
            editingTxnIdx = idx;
            const t = transaksi[idx];
            document.getElementById('txnModalMsg').textContent = '';
            document.getElementById('txnJenisInput').value = t.type;
            document.getElementById('txnTanggalInput').value = t.date;
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
        document.getElementById('txnModalSave').addEventListener('click', () => {
            if (editingTxnIdx === null) return;
            const type = document.getElementById('txnJenisInput').value;
            const date = document.getElementById('txnTanggalInput').value.trim();
            const desc = document.getElementById('txnKetInput').value.trim();
            const cat = document.getElementById('txnKatInput').value.trim();
            const amount = parseInt(document.getElementById('txnJumlahInput').value, 10);
            const msg = document.getElementById('txnModalMsg');
            if (!date || !desc || !cat || !amount) {
                msg.textContent = 'Lengkapi semua kolom dulu ya.';
                return;
            }
            const oldTxn = transaksi[editingTxnIdx];
            const oldContribution = txnContribution(oldTxn);
            transaksi[editingTxnIdx] = {
                desc,
                cat,
                date,
                type,
                amount
            };
            const newContribution = txnContribution(transaksi[editingTxnIdx]);
            saldo = saldo - oldContribution + newContribution;
            closeTxnModal();
            renderLaporan();
            renderDashboard();
            renderRiwayat();
        });

        document.getElementById('btnSimpan').addEventListener('click', () => {
            const jenis = document.getElementById('fJenis').value;
            const tanggal = document.getElementById('fTanggal').value;
            const ket = document.getElementById('fKeterangan').value.trim();
            const jumlah = parseInt(document.getElementById('fJumlah').value, 10);
            const msg = document.getElementById('formMsg');
            if (!ket || !jumlah) {
                msg.textContent = 'Lengkapi keterangan dan jumlah dulu ya.';
                return;
            }
            msg.textContent = '';
            const dateLabel = tanggal ?
                new Date(tanggal).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short'
                }) :
                new Date().toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short'
                });
            transaksi.unshift({
                desc: ket,
                cat: jenis === 'in' ? 'Pemasukan manual' : 'Pengeluaran manual',
                date: dateLabel,
                type: jenis,
                amount: jumlah
            });
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
