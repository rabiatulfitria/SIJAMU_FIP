<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class standarController extends Controller
{
    public function index()
    {
        $standar = Penetapan::where('level_penetapan', 'standarinstitusi')->get();

        return view('User.admin.Penetapan.standarinstitusi', compact('standar'));
    }

    public function create()  //tombol Tambah
    {
        return view('User.admin.Penetapan.tambah_standarspmi');
    }
    
    public function store(Request $request)  //proses Tambah
    {
        $validateData = $request->validate([
            'level_penetapan' => 'required|in:standarspmi',
            'namaDokumen_penetapan' => 'required|string',
            'default-radio-1' => 'required|string',
            'files[].*' => 'required|mimes:doc,docx,xls,xlsx|max:2048'
        ]);
        if ($validateData){
            

            $option = $request->input('default-radio-1');
            $filePaths = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $namaDokumen = time() . '-' . $file->getClientOriginalName();
                    $path = $file->storeAs('storage/app/private', $namaDokumen);
                    $filePaths[] = $path;
                }
            }
    

            $model = new Penetapan();
            $model->level_penetapan = $request->input('level_penetapan');
            $model->namaDokumen_penetapan = $request->input('namaDokumen_penetapan');
            $model->files = json_encode($filePaths);
            $model->status_dokumen = $option;
            $model->save();


            Alert::success('success', 'Dokumen berhasil ditambahkan.');
            return redirect()->route('penetapan.perangkat');
        }
    }

    public function edit(String $id_penetapan)
    {
        $data = Penetapan::where('id_penetapan', $id_penetapan)->first();
        return view('User.admin.Penetapan.edit_standarspmi', [
            'oldData' => $data
        ]);
    }

    public function update(Request $request, String $id_penetapan)
    {
        $dataUpdate = Penetapan::find($id_penetapan);

        $request->validate([
            'level_penetapan' => 'required|in:standarspmi',
            'namaDokumen_penetapan' => 'required|string',
            'radio_option' => 'required|string',
            'files.*' => 'required|mimes:doc,docx,xls,xlsx,url|max:2048'
        ]);

        $dataUpdate->level_penetapan = $request->input('level_penetapan');
        $dataUpdate->namaDokumen_penetapan = $request->input('namaDokumen_penetapan');
        $dataUpdate->files = json_encode($filePaths);
        $dataUpdate->status_dokumen = $option;
        $dataUpdate->save();

        Alert::success('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('penetapan.perangkat');
    }
    
    public function destroy(String $id_penetapan)
    {
        $dataDelete = Penetapan::findOrfail($id_penetapan);
        $dataDelete->delete();

        Alert::success('success', 'Dokumen Perangkat SPMI berhasil dihapus.');
        return redirect()->route('penetapan.perangkat');
    }

}
