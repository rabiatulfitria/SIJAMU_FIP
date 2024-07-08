<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pengendalianController extends Controller
{
    public function index()
    {
        // $jamutims = Timjamu::all();
        return view('User.admin.Pengendalian.index_pengendalian');
    }
}
