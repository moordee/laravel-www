<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavController;
use App\Http\Controllers\BiodataController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/beranda', [NavController::class, 'beranda']);
/*
Route::get('/biodata', [NavController::class, 'biodata']);
Route::get('/tambah_biodata', [NavController::class, 'tambah']);
*/

Route::get('/biodata', [BiodataController::class, 'index']);
Route::get('/tambah_biodata', [BiodataController::class, 'tambah']);
Route::post('/tambah_biodata/create', [BiodataController::class, 'create']);
Route::get('/edit_biodata/{id_siswa}', [BiodataController::class, 'edit']);
Route::put('/edit_biodata/update/{id_siswa}', [BiodataController::class, 'update']);
Route::get('/detail', [BiodataController::class, 'detail']);
Route::get('/biodata/hapus/{id_siswa}', [BiodataController::class, 'destroy']);
Route::get('/detail1', [BiodataController::class, 'detail1']);
