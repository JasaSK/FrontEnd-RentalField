<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class validasiController extends Controller
{
    public function index()
    {
        return view('beranda.validasi');
    }
}
