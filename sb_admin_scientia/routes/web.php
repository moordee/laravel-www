<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/jasa', function () {
    return view('jasa');
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
