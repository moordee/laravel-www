<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller{
    public function beranda(){
        return view('beranda');
    }
    public function biodata(){
        return view('biodata');
    }
    public function tambah(){
        return view('tambah');
    }
}
