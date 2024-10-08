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
        $standar = Penetapan::with('fileP1', 'namaFileP1')
        ->join('file_p1', 'penetapans.id_nfp1', '=', 'file_p1.id_fp1')
        ->join('nama_file_p1', 'nama_file_p1.id_fp1', '=', 'file_p1.id_fp1')
        ->select('penetapans.id_penetapan', 'penetapans.submenu_penetapan', 'nama_file_p1.nama_filep1', 'file_p1.files')
        ->where('submenu_penetapan', 'standarinstitusi')
        ->get();
        // foreach ($standar as $s) {
        //     $files = unserialize($s->files);
        // }
        return view('User.admin.Penetapan.standarinstitusi', compact(['standar'])); //compact(['standar', 'files'])
    }

    public function folder($id)
    {
        $standar = Penetapan::with('fileP1', 'namaFileP1')
        ->join('file_p1', 'penetapans.id_nfp1', '=', 'file_p1.id_fp1')
        ->join('nama_file_p1', 'nama_file_p1.id_fp1', '=', 'file_p1.id_fp1')
        ->select('penetapans.id_penetapan', 'penetapans.submenu_penetapan', 'nama_file_p1.nama_filep1', 'file_p1.files')
        ->where('id_penetapan', $id)
        ->first();
        $files = unserialize($standar->files);
        return view('User.admin.Penetapan.folder_dokumen.dokumen_standarpendidikan', compact('standar', 'files'));
    }

    public function create($id)  //tombol Unggah | $id: mengambil data id di row tabel standarinstitusi.blade // first: mengambil satu data dari satu row
    {
        $penetapan = Penetapan::with('fileP1', 'namaFileP1')
        ->join('file_p1', 'penetapans.id_nfp1', '=', 'file_p1.id_fp1')
        ->join('nama_file_p1', 'nama_file_p1.id_fp1', '=', 'file_p1.id_fp1')
        ->select('penetapans.id_penetapan', 'penetapans.submenu_penetapan', 'nama_file_p1.nama_filep1', 'file_p1.files')
        ->where('id_penetapan', $id)
        ->first();
        $namaDokumen = $penetapan->nama_filep1;
        return view('User.admin.Penetapan.folder_dokumen.tambahdokumen_standarinstitusi')->with(['id' => $id, 'nama' => $namaDokumen]);
    }

    public function uploadDokumen(Request $request)
    {
        $array = Penetapan::find($request->id_penetapan);
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('standarinstitusi', $filename);
            if ($array->files == "") {
                $dokumen = array($filename);
                $array->files = serialize($dokumen); //serialize berfungsi untuk menjadikan inputan file jadi bentuk array. kodenya berupa a:1 (artinya ada 1 array tersimpan)
                $array->save();
            } else {
                $dokumen = unserialize($array->files);
                $dokumen = array_merge($dokumen, array($filename));
                $array->files = serialize($dokumen);
                $array->save();
            }

            Alert::success('success', 'Dokumen berhasil ditambahkan.');
            return redirect()->route('penetapan.standar');
        } else {
            // file kosong
            return response()->json(['error' => 'No file uploaded']);
        }
    }

    public function standar_create() //tambah standar
    {
        return view('User.admin.Penetapan.tambah_standarspmi');
    }

    public function store(Request $request)  //proses Tambah
    {
        // $validateData = $request->validate([
        //     'level_penetapan' => 'required|in:standarinstitusi',
        //     'namaDokumen_penetapan' => 'required|string',
        //     'default-radio-1' => 'required|string',
        // ]);
        // if ($validateData) {
        $model = new Penetapan();
        $model->level_penetapan = $request->level_penetapan;
        $model->namaDokumen_penetapan = $request->namaDokumen_penetapan;
        $model->files = "";
        $model->status_dokumen = $request->input('default-radio-1');
        $model->save();

        Alert::success('success', 'Standar berhasil ditambahkan.');
        return redirect()->route('penetapan.standar');
    }


    public function lihatdokumenstandar($id_penetapan)
    {
        $standar = Penetapan::findOrFail($id_penetapan);
        $filePaths = json_decode($standar->files, true); //string berkode JSON (berupa path file) diterjemahkan ke bentuk array

        if (is_array($filePaths) && !empty($filePaths)) { //memeriksa variabel $filePaths apakah berupa array, dan tidak kosong?
            $file = $filePaths[0];

            if (Storage::disk('local')->exists($file)) {
                return response()->file(storage_path('app' . $file)); //mengarahkan ke file
            } else {
                abort(404, 'File not found.');
            }
        }
    }

    public function edit($id)
    {
        $data = Penetapan::where('id_penetapan', $id)->first();
        return view('User.admin.Penetapan.edit_standarinstitusi', [
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
                Storage::disk('local')->put('/standarinstitusi/' . $namaDokumen, File::get($file));
                $filePaths[] = '/standarinstitusi/' . $namaDokumen;
            }
            $dataUpdate->files = json_encode($filePaths);
        }
        $dataUpdate->save();
        Alert::success('success', 'Pembaruan Berhasil.');
        return redirect()->route('penetapan.standar');
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
        return redirect()->route('penetapan.standar');
    }
}
