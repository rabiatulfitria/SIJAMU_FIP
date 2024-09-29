<?php

namespace App\Http\Controllers;

use App\Models\FileP1;
use App\Models\Penetapan;
use App\Models\NamaFileP1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Console\StorageLinkCommand;

class perangkatController extends Controller
{
    public function index()
    {

        $dokumenp1 = Penetapan::with('fileP1', 'namaFileP1')
            ->join('file_p1', 'penetapans.id_nfp1', '=', 'file_p1.id_fp1')
            ->join('nama_file_p1', 'nama_file_p1.id_fp1', '=', 'file_p1.id_fp1')
            ->select('penetapans.id_penetapan', 'penetapans.submenu_penetapan', 'nama_file_p1.nama_filep1', 'file_p1.files')
            ->where('submenu_penetapan', 'perangkatspmi')
            ->get();

        return view('User.admin.Penetapan.perangkatspmi', compact('dokumenp1'));
    }

    public function create()  //tombol Tambah
    {
        return view('User.admin.Penetapan.tambah_perangkatspmi');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'submenu_penetapan' => 'required|in:perangkatspmi',
            'nama_filep1' => 'required|string',
            'files.*' => 'required|mimes:doc,docx,xls,xlsx|max:2048',
        ]);

        $penetapan = new Penetapan();
        $penetapan->submenu_penetapan = $validatedData['submenu_penetapan'];
        $penetapan->save();

        // Simpan file-file
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $namaDokumen = time() . '-' . $file->getClientOriginalName();
                $path = Storage::disk('local')->put('/perangkatspmi/' . $namaDokumen, $file);

                // Simpan data file ke tabel FileP1
                $fileP1 = new FileP1();
                $fileP1->files = $path;
                $fileP1->save();

                // Hubungkan file dengan penetapan
                $penetapan->fileP1()->save($fileP1);
            }
        }

        // Simpan data nama_filep1
        $namaFileP1 = new NamaFileP1();
        $namaFileP1->nama_filep1 = $validatedData['nama_filep1'];
        $namaFileP1->save();

        $penetapan->namaFileP1()->save($namaFileP1);

        Alert::success('success', 'Dokumen berhasil ditambahkan.');
        return redirect()->route('penetapan.perangkat');
    }

    public function lihatdokumenperangkat($id_penetapan)
    {
        $dokumenp1 = Penetapan::with('fileP1')->findOrFail($id_penetapan);
        $filePaths = json_decode($dokumenp1->files, true);

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
        $data = Penetapan::with('fileP1', 'namaFileP1')
            ->join('file_p1', 'penetapans.id_nfp1', '=', 'file_p1.id_fp1')
            ->join('nama_file_p1', 'nama_file_p1.id_fp1', '=', 'file_p1.id_fp1')
            ->select('penetapans.id_penetapan', 'penetapans.submenu_penetapan', 'nama_file_p1.nama_filep1', 'file_p1.files')
            ->where('penetapans.id_penetapan', $id_penetapan)
            ->first();

        return view('User.admin.Penetapan.edit_perangkatspmi', ['oldData' => $data]);
    }

    public function update(Request $request, $id_penetapan)
    {
        dd($request);

        $dataUpdate = Penetapan::findOrFail($id_penetapan);

        $request->validate([
            'submenu_penetapan' => 'required|in:perangkatspmi',
            'nama_filep1' => 'required|string',
            'files.*' => 'required|mimes:doc,docx,xls,xlsx|max:2048'
        ]);

        $dataUpdate->submenu_penetapan = $request->input('submenu_penetapan');
        $dataUpdate->save();

        $namaFileP1 = NamaFileP1::find($request->input('nama_filep1'));
        $dataUpdate->namaFileP1()->associate($namaFileP1);
        $dataUpdate->save();

        // Proses file baru
        if ($request->hasFile('files')) {
            // Hapus file lama yang tidak ada di request baru
            $oldFilePaths = json_decode($dataUpdate->files, true) ?? [];
            $newFilePaths = [];
            foreach ($request->file('files') as $file) {
                $namaDokumen = time() . '-' . $file->getClientOriginalName();
                $path = Storage::disk('local')->put('/perangkatspmi/' . $namaDokumen, $file);
                $newFilePaths[] = $path;
            }
            $dataUpdate->fileP1()->syncWithoutDetaching($newFilePaths); // Simpan file baru tanpa menghapus yang lama

            // Hapus file lama yang tidak ada di newFilePaths
            $filesToDelete = array_diff($oldFilePaths, $newFilePaths);
            foreach ($filesToDelete as $fileToDelete) {
                Storage::disk('local')->delete($fileToDelete);
            }

            $dataUpdate->files = json_encode($newFilePaths);
        }
        $dataUpdate->save();


        Alert::success('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('penetapan.perangkat');
    }

    public function destroy($id_penetapan)
    {
        $dokumenp1 = Penetapan::findOrFail($id_penetapan);
        $files = json_decode($dokumenp1->files, true);
        if (is_array($files)) {
            foreach ($files as $file) {
                Storage::disk('local')->delete($file);
            }
        }
        $dokumenp1->delete();

        Alert::success('success', 'Dokumen berhasil dihapus.');
        return redirect()->route('penetapan.perangkat');
    }
}
