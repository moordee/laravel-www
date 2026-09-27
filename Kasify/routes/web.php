<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute utama aplikasi Kasify
|--------------------------------------------------------------------------
|
| File ini mengatur halaman yang dapat diakses oleh pengguna setelah login.
| Semua halaman utama seperti beranda, riwayat, transaksi, laporan, dan anggota
| berada di grup middleware 'auth' agar hanya user yang sudah login yang bisa
| membuka fitur ini.
|
| Catatan penting:
| - '/' akan mengarahkan user ke halaman beranda jika sudah login,
|   atau ke halaman login jika belum login.
| - Auth::routes() menambahkan route bawaan Laravel seperti login, logout,
|   dan password reset.
| - 'register' => false berarti fitur pendaftaran tidak aktif untuk aplikasi ini.
|
*/

Route::get('/', function () {
    return redirect()->route(auth()->check() ? 'beranda' : 'login');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('beranda', function () {
        return view('beranda');
    })->name('beranda');

    Route::get('riwayat', function () {
        return view('riwayat');
    })->name('riwayat');

    Route::get('transaksi', function () {
        return view('transaksi');
    })->name('transaksi');

    Route::get('laporan', function () {
        return view('laporan');
    })->name('laporan');

    Route::get('anggota', function () {
        return view('anggota');
    })->name('anggota');

    Route::get('test', function () {
        return view('test');
    })->name('test');
});

Route::get('/home', function () {
    return redirect()->route('beranda');
})->name('home');
