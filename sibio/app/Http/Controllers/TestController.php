<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function checkConnection(){
        try {
            DB::connection()->getPDO();
            $database = DB::connection()->getDatabaseName();
            dd("Connected successfully to database ".$database.".");
        } catch (Exception $e) {
            dd("None");
        }
    }

}
