<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class perangkatController extends Controller
{
    public function index()
    {
        $perangkat = Penetapan::where('level_penetapan', 'perangkatspmi')->get();

        return view('User.admin.Penetapan.perangkatspmi', compact('perangkat'));
    }

    public function create()
    {
        return view('User.admin.Penetapan.tambah_perangkatspmi');
    }
    public function store(Request $request)
    {
        $request->validate([
            'level_penetapan' => 'required|in:perangkatspmi',
            'files.*' => 'required|mimes:doc,docx,xls,xlsx,url|max:2048'
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $namaDokumen = time() . '-' . $file->getClientOriginalName();
                $path = $file->storeAs('private', $namaDokumen);
            }
        }
        $dataBaru = new Penetapan;
        $dataBaru->level_penetapan = $request['level_penetapan'];
        $dataBaru->namaDokumen_penetapan = $request['namaDokumen_penetapan'];
        $dataBaru->files = $request['file_path'];
        $dataBaru->save();

        Alert::success('success', 'Dokumen berhasil ditambahkan.');
        return redirect()->route('penetapan');
    }

    public function edit(String $id_penetapan)
    {
        $data = Penetapan::where('id_penetapan', $id_penetapan)->first();
        return view('User.admin.Penetapan.edit_perangkatspmi', [
            'oldData' => $data
        ]);
    }

    public function update(Request $request, String $id_penetapan)
    {
        $dataUpdate = Penetapan::find($id_penetapan);

        $request->validate([
            'level_penetapan' => 'required|in:perangkatspmi',
            'namaDokumen_penetapan' => 'required|string',
        ]);

        $dataUpdate->level_penetapan = $request['level_penetapan'];
        $dataUpdate->namaDokumen_penetapan = $request['namaDokumen_penetapan'];
        $dataUpdate->save();

        Alert::success('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('penetapan');
    }
    
    public function destroy(String $id_penetapan)
    {
        $dataDelete = Penetapan::findOrfail($id_penetapan);
        $dataDelete->delete();

        Alert::success('success', 'Dokumen Perangkat SPMI berhasil dihapus.');
        return redirect()->route('penetapan');
    }

}
