<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class standarController extends Controller
{
    public function index()
    {
        // $jamutims = Timjamu::all();
        return view('User.admin.Penetapan.index2_penetapan');
    }
}
