<?php

use Illuminate\Support\Facades\Route;

//ini routing halaman welcome
Route::get('/', function () {
    return view('welcome');
});

//ini routing halaman 1
Route::get('/halaman1', function () {
    return view('halaman1');
});

//ini routing halaman 2
Route::get('/halaman2', function () {
    return view('halaman2');
});

Route::get('/halaman3', function() {
    return view('/halaman3');
});

Route::get('/halaman4', function() {
    return view('PW.halaman4');
});

Route::get('/beranda/', function(){
    return view('PW.beranda');
});

Route::get('/custom_halaman1', function(){
    return view('PW.halaman_1');
});
Route::get('/custom_halaman2', function(){
    return view('PW.halaman_2');
});
Route::get('/custom_halaman3', function(){
    return view('PW.halaman_3');
});

Route::get('/index', function(){
    return view('index');
});

