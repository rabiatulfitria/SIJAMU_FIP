<?php

namespace App\Http\Controllers;

use App\Models\Timjamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'nama' => 'required',
            'email' => 'required|email|unique:jamutims',
            'PJ' => 'required',
        ]);
        
        $dataBaru = new TimJamu;
        $dataBaru->nip = $request['nip'];
        $dataBaru->nama = $request['nama'];
        $dataBaru->email = $request['email'];
        $dataBaru->PJ = $request['PJ'];
        $dataBaru->save();

        return redirect()->route('TimJAMU')->with('success', 'Tim JAMU berhasil ditambahkan.');
    }

    public function edit( String $id)
    {
        $data = TimJamu::where('id',$id)->first();
        return view('User.admin.editTimjamu', [
            'oldData' => $data
        ]);
    }

    public function update(Request $request, String $id)
    {
        $dataUpdate = TimJamu::find($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'PJ' => 'required',
        ]);

        $dataUpdate->nama = $request['nama'];
        $dataUpdate->email = $request['email'];
        $dataUpdate->PJ = $request['PJ'];
        $dataUpdate->save();


        return redirect()->route('TimJAMU')->with('success', 'Tim JAMU berhasil diperbarui.');
    }

    public function destroy(String $id)
    {
        $dataDelete = TimJamu::findOrfail($id);
        $dataDelete->delete();

        return redirect()->route('TimJAMU')->with('success', 'Tim JAMU berhasil dihapus.');
    }
}
