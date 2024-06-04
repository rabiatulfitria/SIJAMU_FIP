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
        // dd($request->all());

        return redirect()->route('TimJAMU')->with('success', 'Tim JAMU berhasil ditambahkan.');
    }

    public function edit( Timjamu $jamutims)
    {
        return view('User.admin.editTimjamu', compact('jamutims'));
    }

    public function update(Request $request, Timjamu $jamutims)
    {
        $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:jamutims',
            'PJ' => 'required',
        ]);

        $jamutims->update($request->all());

        return redirect()->route('TimJAMU')->with('success', 'Tim JAMU berhasil diperbarui.');
    }

    public function destroy(Timjamu $jamutims)
    {
        $jamutims->delete();

        return redirect()->route('TimJAMU')->with('success', 'Tim JAMU berhasil dihapus.');
    }
}
