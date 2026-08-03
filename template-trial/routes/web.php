<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('muvid', function () {
    return view('indexMuvid');
});

Route::get('muvid-id', function () {
    return view('indexMuvidID');
});

Route::get('nexus', function () {
    return view('indexNexus');
});

Route::get('visit', function () {
    return view('visitBot');
});
