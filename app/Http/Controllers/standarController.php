<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class standarController extends Controller
{
    public function index()
    {
        // $standar = Penetapan::where('level_penetapan', 'standarinstitusi')->get();

        $standar = Penetapan::where('level_penetapan', 'standarinstitusi') //nomor 1, id sesuaikan
                    ->where('id_penetapan', 32)
                    ->first();
        $standar2 = Penetapan::where('level_penetapan', 'standarinstitusi') // nomor 2, id sesuaikan
                    ->where('id_penetapan', 33)
                    ->first();
        $standar3 = Penetapan::where('level_penetapan', 'standarinstitusi') // nomor 3, id sesuaikan
                    ->where('id_penetapan', 34)
                    ->first();
        $standar4 = Penetapan::where('level_penetapan', 'standarinstitusi') // nomor 4, id selain nomor 1-3
                    ->whereNotIn('id_penetapan', [32, 33, 34, 35])->get();

        // dd($standar);

        return view('User.admin.Penetapan.standarinstitusi', compact('standar', 'standar2', 'standar3', 'standar4'));
    }

    public function folder()
    {
        // $jamutims = Timjamu::all();
        return view('User.admin.Penetapan.folder_dokumen.dokumen_standarpendidikan');
    }

    public function create($id)  //tombol Tambah
    {
        $penetapan = Penetapan::where('id_penetapan',$id)->first(); //mengambil satu data dari satu row
        $namaDokumen = $penetapan->namaDokumen_penetapan;
        return view('User.admin.Penetapan.tambah_standarspmi')->with(['id'=>$id,'nama'=>$namaDokumen]);
    }

    public function uploadDokumen(Request $request){
        $array = Penetapan::find($request->id_penetapan);
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename);
            if($array->files ==""){
                $dokumen = array($filename);
                $array->files = serialize($dokumen); //inputan file dijadikan bentuk array
                $array->save();
            }
            else{
                $dokumen = unserialize($array->files);
                $dokumen = array_merge($dokumen,array($filename));
                $array->files = serialize($dokumen);
                $array->save();
            }      
            return response()->json(['success' => 'File uploaded successfully']);
        } else {
            // file kosong
            return response()->json(['error' => 'No file uploaded']);
        }
    }

    public function store(Request $request)  //proses Tambah
    {
        $validateData = $request->validate([
            'level_penetapan' => 'required|in:standarinstitusi',
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

                    // Memindahkan file ke folder 'storage/app/private' dengan nama yang telah dibuat
                    Storage::disk('local')->put('/private/' . $namaDokumen, File::get($file));

                    // Menyimpan path ke dalam array
                    $path = '/private/' . $namaDokumen;
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

    public function viewSensitifFile($id_penetapan)
    {
        $standar = Penetapan::findOrFail($id_penetapan);
        $filePaths = json_decode($standar->files, true);

        if (is_array($filePaths) && !empty($filePaths)) {
            $file = $filePaths[0];

            if (Storage::disk('local')->exists($file)) {
                return response()->file(storage_path('app' . $file));
            } else {
                abort(404, 'File not found.');
            }
        }
    }

    public function edit(String $id_penetapan)
    {
        $data = Penetapan::where('id_penetapan', $id_penetapan)->first();
        return view('User.admin.Penetapan.edit_standarspmi', [
            'oldData' => $data
        ]);
    }

    public function update(Request $request, $id_penetapan)
    {
        $dataUpdate = Penetapan::findOrFail($id_penetapan);

        $request->validate([
            'level_penetapan' => 'required|in:standarinstitusi',
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
                Storage::disk('local')->put('/private/' . $namaDokumen, File::get($file));
                $filePaths[] = '/private/' . $namaDokumen;
            }
            $dataUpdate->files = json_encode($filePaths);
        }
        $dataUpdate->save();
        Alert::success('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('penetapan.perangkat');
    }

    public function destroy($id_penetapan)
    {
        $standar = Penetapan::findOrFail($id_penetapan);
        $files = json_decode($standar->files, true);
        if (is_array($files)) {
            foreach ($files as $file) {
                Storage::disk('local')->delete($file);
            }
        }
        $standar->delete();
    
        Alert::success('success', 'Dokumen berhasil dihapus.');
        return redirect()->route('penetapan.perangkat');
    }

}
