<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class evaluasiController extends Controller
{
    public function index()
    {
        $evaluasi = Evaluasi::all();
        return view('User.admin.Evaluasi.index_evaluasi', compact('evaluasi'));
    }
    public function create()
    {
        return view('User.admin.Evaluasi.tambah_evaluasi');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'namaDokumen_evaluasi' => 'required|string',
            'program_studi' => 'required|string',
            'tanggal_terakhir_dilakukan' => 'required|date',
            'tanggal_diperbarui' => 'required|date',
            'unggahan_dokumen[].*' => 'required|mimes:doc,docx,xls,xlsx|max:2048',
        ]);
        $namaDokumen = $request->namaDokumen_evaluasi === 'Dokumen Lainnya' ? $request->input('manual_namaDokumen') : $request->namaDokumen_evaluasi;

        if ($validateData) {

            $filePaths = [];

            dd(Storage::disk());
            if ($request->hasFile('unggahan_dokumen')) {
                foreach ($request->file('unggahan_dokumen') as $file) {
                    $namaDokumen = time() . '-' . $file->getClientOriginalName();
                    dd(Storage::disk('local')->put('/evaluasi(AMI)/' . $namaDokumen, File::get($file)));

                    // Menyimpan path ke dalam array
                    $path = '/evaluasi(AMI)/' . $namaDokumen;
                    $filePaths[] = $path;
                    
                }
            }

            $model = new Evaluasi();
            $model->namaDokumen_evaluasi = $request->input('namaDokumen_penetapan');
            $model->program_studi = $request->input('program_studi');
            $model->tanggal_terakhir_dilakukan = $request->input('tanggal_terakhir_dilakukan');
            $model->tanggal_diperbarui = $request->input('tanggal_diperbarui');
            $model->unggahan_dokumen = json_encode($filePaths);
            $model->save();

            Alert::success('success', 'Dokumen berhasil ditambahkan.');
            return redirect()->route('evaluasi');
        }
    }

    public function lihatdokumenevaluasi($id_evaluasi)
    {
        $evaluasi = Evaluasi::findOrFail($id_evaluasi);
        $filePaths = json_decode($evaluasi->unggahan_dokumen, true);

        if (is_array($filePaths) && !empty($filePaths)) {
            $file = $filePaths[0];

            if (Storage::disk('local')->exists($file)) {
                return response()->file(storage_path('app' . $file));
            } else {
                abort(404, 'File not found.');
            }
        }
    }

    public function edit(String $id_evaluasi)
    {
        $dataEvaluasi = Evaluasi::where('id_evaluasi', $id_evaluasi)->first();
        return view('User.admin.Evaluasi.edit_evaluasi', [
            'oldData' => $dataEvaluasi
        ]);
    }

    public function update(Request $request, String $id_evaluasi)
    {
        $dataUpdate = Evaluasi::findOrFail($id_evaluasi);

        $request->validate([
            'namaDokumen_evaluasi' => 'required|string',
            'program_studi' => 'required|string',
            'tanggal_terakhir_dilakukan' => 'required|date',
            'tanggal_diperbarui' => 'required|date',
            'unggahan_dokumen[].*' => 'required|mimes:doc,docx,xls,xlsx|max:2048'
        ]);

        $dataUpdate->namaDokumen_evaluasi = $request->input('namaDokumen_evaluasi');
        $dataUpdate->program_studi = $request->input('program_studi');
        $dataUpdate->tanggal_terakhir_dilakukan = $request->input('tanggal_terakhir_dilakukan');
        $dataUpdate->tanggal_diperbarui = $request->input('tanggal-diperbarui');

        // Proses file baru jika ada
        if ($request->hasFile('unggahan_dokumen')) {
            // Hapus file lama dari storage
            $oldFiles = json_decode($dataUpdate->unggahan_dokumen, true);
            if (is_array($oldFiles)) {
                foreach ($oldFiles as $oldFile) {
                    if (Storage::disk('local')->exists($oldFile)) {
                        Storage::disk('local')->delete($oldFile);
                    }
                }
            }
            $filePaths = [];
            foreach ($request->file('unggahan_dokumen') as $file) {
                $namaDokumen = time() . '-' . $file->getClientOriginalName();
                Storage::disk('local')->put('/evaluasi(AMI)/' . $namaDokumen, File::get($file));
                $filePaths[] = '/evaluasi(AMI)/' . $namaDokumen;
            }
            $dataUpdate->unggahan_dokumen = json_encode($filePaths);
        }
        $dataUpdate->save();

        Alert::success('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('evaluasi');
    }

    public function destroy(String $id_evaluasi)
    {
        $dataDelete = Evaluasi::findOrfail($id_evaluasi);
        $dataDelete->delete();

        Alert::success('success', 'Dokuumen berhasil dihapus.');
        return redirect()->route('evaluasi');
    }
}
