<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class perangkatController extends Controller
{
    public function index()
    {
        $perangkat = Penetapan::where('level_penetapan', 'perangkatspmi')->get();
        $standar = Penetapan::where('level_penetapan', 'standarinstitusi')->get();

        return view('User.admin.Penetapan.perangkatspmi', compact('perangkat', 'standar'));
    }

    public function create()
    {
        return view('User.admin.Penetapan.tambah_perangkatspmi');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nip' => 'required',
        //     'nama' => 'required',
        //     'email' => 'required|email|unique:jamutims',
        //     'PJ' => 'required',
        // ]);
        
        // $dataBaru = new TimJamu;
        // $dataBaru->nip = $request['nip'];
        // $dataBaru->nama = $request['nama'];
        // $dataBaru->email = $request['email'];
        // $dataBaru->PJ = $request['PJ'];
        // $dataBaru->save();

        Alert::success('success', 'Tim JAMU berhasil ditambahkan.');
        return redirect()->route('TimJAMU');
    }

    public function edit( String $id)
    {
        // $data = TimJamu::where('id',$id)->first();
        // return view('User.admin.editTimjamu', [
        //     'oldData' => $data
        // ]);
    }

    public function update(Request $request, String $id)
    {
        // $dataUpdate = TimJamu::find($id);

        // $request->validate([
        //     'nip' => 'required',
        //     'nama' => 'required',
        //     'email' => 'required|email',
        //     'PJ' => 'required',
        // ]);

        // $dataUpdate->nip = $request['nip'];
        // $dataUpdate->nama = $request['nama'];
        // $dataUpdate->email = $request['email'];
        // $dataUpdate->PJ = $request['PJ'];
        // $dataUpdate->save();

        Alert::success('success', 'Tim JAMU berhasil diperbarui.');
        return redirect()->route('TimJAMU');
    }
}
