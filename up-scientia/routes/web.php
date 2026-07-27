<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', [BarangController::class, 'beranda']);
