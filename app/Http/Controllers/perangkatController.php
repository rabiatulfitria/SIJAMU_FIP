<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $validateData = $request->validate([
            'level_penetapan' => 'required|in:perangkatspmi',
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
                    $path = $file->storeAs('public/private', $namaDokumen);
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
            'radio_option' => 'required|string',
            'files.*' => 'required|mimes:doc,docx,xls,xlsx,url|max:2048'
        ]);

        $dataUpdate->level_penetapan = $request['level_penetapan'];
        $dataUpdate->namaDokumen_penetapan = $request['namaDokumen_penetapan'];
        $dataUpdate->files = $request['file_path'];
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
