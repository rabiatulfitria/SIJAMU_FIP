<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class perangkatController extends Controller
{
    public function index()
    {
        // $jamutims = Timjamu::all();
        return view('User.admin.Penetapan.index1_penetapan');
    }
}
