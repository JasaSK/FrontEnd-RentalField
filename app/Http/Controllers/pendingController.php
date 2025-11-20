<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pendingController extends Controller
{
    public function index()
    {
        return view('beranda.pending');
    }
}
