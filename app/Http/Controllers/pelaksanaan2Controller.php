<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pelaksanaan2Controller extends Controller
{
    public function index()
    {
        // $jamutims = Timjamu::all();
        return view('User.admin.Pelaksanaan.index_fakultas');
    }
}
