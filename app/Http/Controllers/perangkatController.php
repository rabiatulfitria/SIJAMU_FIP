<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class perangkatController extends Controller
{
    public function index()
    {
        $perangkat = Penetapan::where('level_penetapan', 'perangkatspmi')->get();

        return view('User.admin.Penetapan.perangkatspmi', compact('perangkat'));
    }

    public function create()  //tombol Tambah
    {
        return view('User.admin.Penetapan.tambah_perangkatspmi');
    }

    public function store(Request $request)  //proses Tambah
    {
        $validateData = $request->validate([
            'level_penetapan' => 'required|in:perangkatspmi',
            'namaDokumen_penetapan' => 'required|string',
            'default-radio-1' => 'required|string',
            'files[].*' => 'required|mimes:doc,docx,xls,xlsx|max:2048'
        ]);
        if ($validateData) {


            $option = $request->input('default-radio-1');
            $filePaths = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $namaDokumen = time() . '-' . $file->getClientOriginalName();

                    // Memindahkan file ke folder 'storage/app/perangkatspmi' dengan nama yang telah dibuat
                    Storage::disk('local')->put('/perangkatspmi/' . $namaDokumen, File::get($file));

                    // Menyimpan path ke dalam array
                    $path = '/perangkatspmi/' . $namaDokumen;
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

    // public function viewSensitifFile($id_penetapan)
    // {
    //     //Cari file berdasarkan id_penetapan
    //     $perangkat = Penetapan::findOrFail($id_penetapan);

    //     //ambil path file dari database
    //     $filePaths = $perangkat->files;
        
    //     //cek apakah file ada di storage lokal
    //     if (file_exists($filePaths)) {
    //         return response()->file($filePaths);
    //     }
    // }

    public function lihatdokumenperangkat($id_penetapan)
    {
        $perangkat = Penetapan::findOrFail($id_penetapan);
        $filePaths = json_decode($perangkat->files, true);

        if (is_array($filePaths) && !empty($filePaths)) {
            $file = $filePaths[0];

            if (Storage::disk('local')->exists($file)) {
                return response()->file(storage_path('app/perangkatspmi' . $file));
            } else {
                abort(404, 'File not found.');
            }
        }
    }

    public function edit(String $id_penetapan)
    {
        $data = Penetapan::where('id_penetapan', $id_penetapan)->first();
        return view('User.admin.Penetapan.edit_perangkatspmi', [
            'oldData' => $data
        ]);
    }

    public function update(Request $request, $id_penetapan)
    {
        $dataUpdate = Penetapan::findOrFail($id_penetapan);

        $request->validate([
            'level_penetapan' => 'required|in:perangkatspmi',
            'nama_dokumen' => 'required|string',
            'default-radio-1' => 'required|string',
            'files.*' => 'nullable|mimes:doc,docx,xls,xlsx,pdf|max:2048'
        ]);

        $dataUpdate->namaDokumen_penetapan = $request->input('nama_dokumen');
        $dataUpdate->status_dokumen = $request->input('default-radio-1');

        // Proses file baru jika ada
        if ($request->hasFile('files')) {
            // Hapus file lama dari storage
            $oldFiles = json_decode($dataUpdate->files, true);
            if (is_array($oldFiles)) {
                foreach ($oldFiles as $oldFile) {
                    if (Storage::disk('local')->exists($oldFile)) {
                        Storage::disk('local')->delete($oldFile);
                    }
                }
            }
            $filePaths = [];
            foreach ($request->file('files') as $file) {
                $namaDokumen = time() . '-' . $file->getClientOriginalName();
                Storage::disk('local')->put('/perangkatspmi/' . $namaDokumen, File::get($file));
                $filePaths[] = '/perangkatspmi/' . $namaDokumen;
            }
            $dataUpdate->files = json_encode($filePaths);
        }
        $dataUpdate->save();
        Alert::success('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('penetapan.perangkat');
    }




    public function destroy($id_penetapan)
    {
        $perangkat = Penetapan::findOrFail($id_penetapan);
        $files = json_decode($perangkat->files, true);
        if (is_array($files)) {
            foreach ($files as $file) {
                Storage::disk('local')->delete($file);
            }
        }
        $perangkat->delete();
    
        Alert::success('success', 'Dokumen berhasil dihapus.');
        return redirect()->route('penetapan.perangkat');
    }
}