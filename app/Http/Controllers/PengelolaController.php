<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengelolaController extends Controller
{
    public function index(Request $request)
    {
        return view('pengelola.index');        
    }
}
