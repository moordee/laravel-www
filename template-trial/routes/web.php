<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('muvid', function () {
    return view('indexMuvid');
});

Route::get('nexus', function () {
    return view('indexNexus');
});
