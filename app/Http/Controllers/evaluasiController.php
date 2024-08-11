<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class evaluasiController extends Controller
{
    public function index()
    {
        $evaluasis = Evaluasi::all();
        return view('User.admin.Evaluasi.index_evaluasi', compact('evaluasis'));
    }
    public function create()
    {
        return view('User.admin.Evaluasi.tambah_evaluasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email|unique:jamutims',
            'PJ' => 'required',
        ]);
        
        $dataBaru = new Evaluasi;
        $dataBaru->nip = $request['nip'];
        $dataBaru->nama = $request['nama'];
        $dataBaru->email = $request['email'];
        $dataBaru->PJ = $request['PJ'];
        $dataBaru->save();

        Alert::success('success', 'Tim JAMU berhasil ditambahkan.');
        return redirect()->route('TimJAMU');
    }

    public function edit( String $id)
    {
        $data = Evaluasi::where('id',$id)->first();
        return view('User.admin.TimJMF.editTimjamu', [
            'oldData' => $data
        ]);
    }

    public function update(Request $request, String $id)
    {
        $dataUpdate = Evaluasi::find($id);

        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'PJ' => 'required',
        ]);

        $dataUpdate->nip = $request['nip'];
        $dataUpdate->nama = $request['nama'];
        $dataUpdate->email = $request['email'];
        $dataUpdate->PJ = $request['PJ'];
        $dataUpdate->save();

        Alert::success('success', 'Tim JAMU berhasil diperbarui.');
        return redirect()->route('TimJAMU');
    }

    public function destroy(String $id)
    {
        $dataDelete = Evaluasi::findOrfail($id);
        $dataDelete->delete();

        Alert::success('success', 'Tim JAMU berhasil dihapus.');
        return redirect()->route('TimJAMU');
    }

}
