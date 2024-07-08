<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class evaluasiController extends Controller
{
    public function index()
    {
        // $jamutims = Timjamu::all();
        return view('User.admin.Evaluasi.index_evaluasi');
    }
}
