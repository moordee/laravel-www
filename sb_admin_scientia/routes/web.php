<?php

use Illuminate\Support\Facades\Route;

Route::get('/def', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('layout.master');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/jasa', function () {
    return view('layouts.jasa');
});

Route::get('/transaksi', function () {
    return view('layouts.transaksi');
});

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/password', function () {
    return view('password');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/tables', function () {
    return view('tables');
});

Route::get('/sidenav-light', function () {
    return view('layout-sidenav-light');
});

Route::get('/static', function () {
    return view('layout-static');
});

Route::get('/401', function () {
    return view('401');
});

Route::get('/404', function () {
    return view('404');
});

Route::get('/500', function () {
    return view('500');
});
