<?php

namespace App\Http\Controllers;

use App\Models\FileP1;
use App\Models\Penetapan;
use App\Models\NamaFileP1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Console\StorageLinkCommand;

class perangkatController extends Controller
{
    public function index()
    {
        $dokumenp1 = DB::table('dokumen_spmi')
        ->join('tabel_prodi', 'dokumen_spmi.namaprodi', '=', 'tabel_prodi.id_prodi')
        ->select('dokumen_spmi.*', 'tabel_prodi.nama_prodi')
        ->get();

        return view('User.admin.Penetapan.perangkatspmi', compact('dokumenp1'));
    }

    public function create()  //tombol Tambah
    {
        // Mengambil data nama_prodi dari tabel_prodi
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        // Mengirim data ke view
        return view('User.admin.Penetapan.tambah_perangkatspmi', compact('prodi'));
    }

    public function store(Request $request)
    {
        {
            $request->validate([
                'nama_filep1' => 'required|string|max:255',
                'kategori' => 'required|string',
                'tahun' => 'required|numeric|min:1900|max:2099',
                'nama_prodi' => 'required|exists:tabel_prodi,id_prodi',
                'files' => 'required',
                'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:2048'
            ]);

            try {
                DB::beginTransaction();

                foreach ($request->file('files') as $file) {
                    // Generate unique file name
                    $namaDokumen = time() . '-' . $file->getClientOriginalName();

                    // Store file in the 'public/perangkatspmi' directory
                    $path = $file->storeAs('perangkatspmi', $namaDokumen, 'public');

                    // Insert data into 'dokumen_spmi' table
                    DB::table('dokumen_spmi')->insert([
                        'namafile' => $request->nama_filep1,
                        'kategori' => $request->kategori,
                        'tahun' => $request->tahun,
                        'namaprodi' => $request->nama_prodi,
                        'file' => $path,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

                DB::commit();
                Alert::success('success', 'Dokumen berhasil ditambahkan.');
                return redirect()->route('penetapan.perangkat');
            } catch (\Exception $e) {
                DB::rollBack();
                Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }
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

    public function edit(String $id)
    {
        // Ambil data dokumen_spmi yang ingin diedit
        $dokumenp1 = DB::table('dokumen_spmi')
            ->join('tabel_prodi', 'dokumen_spmi.namaprodi', '=', 'tabel_prodi.id_prodi')
            ->select('dokumen_spmi.*', 'tabel_prodi.nama_prodi')
            ->where('dokumen_spmi.id', '=', $id)
            ->first();

        // Ambil daftar program studi untuk dropdown
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        // Kirim data ke view
        return view('User.admin.Penetapan.edit_perangkatspmi', ['oldData' => $dokumenp1, 'prodi' => $prodi]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_filep1' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tahun' => 'required|numeric|min:1900|max:2099',
            'nama_prodi' => 'required|exists:tabel_prodi,id_prodi',
            'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            // Ambil data lama dari tabel
            $dokumen = DB::table('dokumen_spmi')->where('id', $id)->first();

            // Update data di database
            DB::table('dokumen_spmi')
                ->where('id', $id)
                ->update([
                    'namafile' => $request->nama_filep1,
                    'kategori' => $request->kategori,
                    'tahun' => $request->tahun,
                    'namaprodi' => $request->nama_prodi,
                    'updated_at' => now()
                ]);

            // Jika ada file baru diunggah, hapus file lama dan simpan file baru
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Hapus file lama jika ada
                    if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                        Storage::delete('public/' . $dokumen->file);
                    }

                    // Generate unique file name
                    $namaFile = time() . '-' . $file->getClientOriginalName();
                    $path = $file->storeAs('standar', $namaFile, 'public');

                    // Update path file baru di database
                    DB::table('dokumen_spmi')
                        ->where('id', $id)
                        ->update(['file' => $path]);
                }
            }

            DB::commit();
            Alert::success('success', 'Dokumen berhasil diupdate.');
            return redirect()->route('penetapan.perangkat');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function destroy(String $id)
    {
        try {
            // Ambil data dokumen berdasarkan id
            $dokumen = DB::table('dokumen_spmi')->where('id', $id)->first();

            // Pastikan data dokumen ditemukan
            if ($dokumen) {
                // Hapus file dari storage
                if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                    Storage::delete('public/' . $dokumen->file);
                }

                // Hapus data dari tabel dokumen_spmi
                DB::table('dokumen_spmi')->where('id', $id)->delete();


                Alert::success('success', 'Dokumen berhasil dihapus.');
                return redirect()->route('penetapan.perangkat');
            } else {

                Alert::success('error', 'Dokumen gagal dihapus.');
                return redirect()->route('penetapan.perangkat');
            }
        } catch (\Exception $e) {

            Alert::success('error', 'Dokumen gagal dihapus.');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
