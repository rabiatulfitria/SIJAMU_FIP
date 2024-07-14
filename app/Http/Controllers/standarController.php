<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;

class standarController extends Controller
{
    public function index()
    {
        $standar = Penetapan::where('level_penetapan', 'standarinstitusi')->get();

        return view('User.admin.Penetapan.standarinstitusi', compact('standar'));
    }
}
