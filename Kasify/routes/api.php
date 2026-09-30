<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API resource untuk CRUD aplikasi Kasify
|--------------------------------------------------------------------------
|
| Semua endpoint di sini digunakan oleh sisi frontend untuk melakukan operasi
| create, read, update, dan delete tanpa harus me-refresh halaman.
|
| Data transaksi dan data anggota diproses melalui controller yang terpisah agar
| logika bisnis tidak tercampur dengan view Blade.
|
*/

Route::apiResource('transaksi', TransactionController::class)->parameters([
    'transaksi' => 'transaction',
]);
Route::apiResource('anggota', AnggotaController::class)->parameters([
    'anggota' => 'anggota',
]);
