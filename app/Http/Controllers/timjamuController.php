<?php

namespace App\Http\Controllers;

use App\Models\Timjamu;
use Illuminate\Http\Request;

class timjamuController extends Controller
{
    public function index()
    {
        $jamutims = Timjamu::all();
        return view('User.admin.timjamu', compact('jamutims'));
    }

    public function create()
    {
        return view('User.admin.tambahTimjamu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:jamutims',
            'PJ' => 'required',
        ]);

        Timjamu::create($request->all());

        return redirect('/TimPenjaminanMutu')->with('success', 'Tim JAMU created successfully.');
    }
}
