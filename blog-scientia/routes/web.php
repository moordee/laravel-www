<?php

use Illuminate\Support\Facades\Route;

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/joost', function () {
    return view('joost');
});

Route::get('/berandae', function () {
    return view('berandae');
});

Route::get('/eurovision-2024', function () {
    return view('/eurovision-2024');
});

Route::get('/eurovision-2025', function () {
    return view('/eurovision-2025');
});

Route::get('/kaleen', function () {
    return view('/kaleen');
});

Route::get('/ladaniva', function () {
    return view('/ladaniva');
});

Route::get('/lucio', function () {
    return view('/lucio');
});
Route::get('/tommy', function () {
    return view('/tommy');
});

Route::get('/abor-tynna', function () {
    return view('/abor-tynna');
});
