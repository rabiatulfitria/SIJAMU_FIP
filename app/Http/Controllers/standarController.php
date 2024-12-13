<?php

namespace App\Http\Controllers;

use App\Models\Penetapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isNull;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class standarController extends Controller
{
    public function index()
    {
         // Mengambil data dari tabel standar_institutusi beserta nama prodi dari tabel_prodi
         $dokumenp1 = DB::table('standar_institutusi')
         ->join('tabel_prodi', 'standar_institutusi.namaprodi', '=', 'tabel_prodi.id_prodi')
         ->select('standar_institutusi.*', 'tabel_prodi.nama_prodi')
         ->get();
        // foreach ($standar as $s) {
        //     $files = unserialize($s->files);
        // }
        return view('User.admin.Penetapan.standarinstitusi', compact('dokumenp1')); //compact(['standar', 'files'])
    }

    // public function folder($id)
    // {
    //     $standar = Penetapan::with('fileP1', 'namaFileP1')
    //     ->join('file_p1', 'penetapans.id_nfp1', '=', 'file_p1.id_fp1')
    //     ->join('nama_file_p1', 'nama_file_p1.id_fp1', '=', 'file_p1.id_fp1')
    //     ->select('penetapans.id_penetapan', 'penetapans.submenu_penetapan', 'nama_file_p1.nama_filep1', 'file_p1.files')
    //     ->where('id_penetapan', $id)
    //     ->first();
    //     $files = unserialize($standar->files);
    //     return view('User.admin.Penetapan.folder_dokumen.dokumen_standarpendidikan', compact('standar', 'files'));
    // }

    // public function create($id)  //tombol Unggah | $id: mengambil data id di row tabel standarinstitusi.blade // first: mengambil satu data dari satu row
    // {
    //     $penetapan = DB::table('penetapans')
    //     ->select(
    //         'penetapans.id_penetapan',
    //         'penetapans.submenu_penetapan',
    //         'penetapans.id_nfp1',
    //         'penetapans.id_fp1',
    //         'nama_file_p1.nama_filep1',  // Ambil nama_filep1 dari tabel nama_file_p1
    //         'file_p1.files'  // Ambil files dari tabel file_p1
    //     )
    //     ->join('nama_file_p1', 'penetapans.id_nfp1', '=', 'nama_file_p1.id_nfp1')  // Join ke nama_file_p1 berdasarkan id_nfp1
    //     ->join('file_p1', 'penetapans.id_fp1', '=', 'file_p1.id_fp1')  // Join ke file_p1 berdasarkan id_fp1
    //     ->where('id_penetapan', $id)
    //     ->first();
    //     $namaDokumen = $penetapan->nama_filep1;
    //     return view('User.admin.Penetapan.folder_dokumen.tambahdokumen_standarinstitusi')->with(['id' => $id, 'nama' => $namaDokumen]);
    // }

    public function uploadDokumen(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id_penetapan' => 'required',
                'files.*' => 'nullable|mimes:doc,docx,xls,xlsx,pdf|max:5120', //Maksimum 5120 KB (5 MB)
            ]);

            // Dapatkan id_penetapan dari request
            $idPenetapan = $validatedData['id_penetapan'];

            // Cek apakah ada file baru yang diunggah
            if ($request->hasFile('files')) {
                $namaDokumen = [];
                foreach ($request->file('files') as $file) {
                    $namaFile = time() . '-' . $file->getClientOriginalName();
                    $file->storeAs('standar', $namaFile, 'public');
                    $namaDokumen[] = $namaFile;  // Simpan nama file di array
                }

                // Gabungkan nama file menjadi string
                if (!empty($namaDokumen)) {
                    $namaDokumen = implode(',', $namaDokumen);
                }

                // Update hanya kolom files di tabel FileP1 yang terkait dengan penetapan
                DB::table('file_p1')
                    ->join('penetapans', 'file_p1.id_fp1', '=', 'penetapans.id_fp1')
                    ->where('penetapans.id_penetapan', $idPenetapan)
                    ->update([
                        'file_p1.files' => $namaDokumen,
                        'file_p1.updated_at' => now(),
                    ]);

                // Tampilkan pesan sukses
                Alert::success('success', 'Dokumen berhasil diperbarui.');
                return redirect()->route('penetapan.standar');
            }

            // Jika tidak ada file yang diunggah, tetap kembalikan response
            Alert::info('info', 'Tidak ada file yang diunggah.');
            return redirect()->back();
        } catch (\Exception $e) {
            // Menangkap semua error dan menampilkan pesan kesalahan
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function standar_create() //tambah standar
    {
        // Mengambil data nama_prodi dari tabel_prodi
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        // Mengirim data ke view
        return view('User.admin.Penetapan.tambah_standarspmi', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_filep1' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tahun' => 'required|numeric|min:1900|max:2099',
            'nama_prodi' => 'required|exists:tabel_prodi,id_prodi',
            'files' => 'required',
            'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:5120' //Maksimum 5120 KB (5 MB)
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->file('files') as $file) {
                // Generate unique file name
                $namaFile = time() . '-' . $file->getClientOriginalName();

                // Store file in the 'public/standar' directory
                $path = $file->storeAs('standar', $namaFile, 'public');

                // Insert data into 'standar_institutusi' table
                DB::table('standar_institutusi')->insert([
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
            return redirect()->route('penetapan.standar');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
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

    public function edit(String $id)
    {
        // Ambil data standar_institutusi yang ingin diedit
        $dokumenp1 = DB::table('standar_institutusi')
            ->join('tabel_prodi', 'standar_institutusi.namaprodi', '=', 'tabel_prodi.id_prodi')
            ->select('standar_institutusi.*', 'tabel_prodi.nama_prodi')
            ->where('standar_institutusi.id_standarinstitut', '=', $id)
            ->first();

        // Ambil daftar program studi untuk dropdown
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        // Kirim data ke view
        return view('User.admin.Penetapan.edit_standarinstitusi', ['oldData' => $dokumenp1, 'prodi' => $prodi]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_filep1' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tahun' => 'required|numeric|min:1900|max:2099',
            'nama_prodi' => 'required|exists:tabel_prodi,id_prodi',
            'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:5120' //Maksimum 5120 KB (5 MB)
        ]);

        try {
            DB::beginTransaction();

            // Ambil data lama dari tabel
            $dokumen = DB::table('standar_institutusi')->where('id_standarinstitut', $id)->first();

            // Update data di database
            DB::table('standar_institutusi')
                ->where('id_standarinstitut', $id)
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
                    DB::table('standar_institutusi')
                        ->where('id_standarinstitut', $id)
                        ->update(['file' => $path]);
                }
            }

            DB::commit();
            Alert::success('success', 'Dokumen berhasil diupdate.');
            return redirect()->route('penetapan.standar');
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
            $dokumen = DB::table('standar_institutusi')->where('id_standarinstitut', $id)->first();

            // Pastikan data dokumen ditemukan
            if ($dokumen) {
                // Hapus file dari storage
                if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                    Storage::delete('public/' . $dokumen->file);
                }

                // Hapus data dari tabel standar_institutusi
                DB::table('standar_institutusi')->where('id_standarinstitut', $id)->delete();


                Alert::success('success', 'Dokumen berhasil dihapus.');
                return redirect()->route('penetapan.standar');
            } else {

                Alert::success('error', 'Dokumen gagal dihapus.');
                return redirect()->route('penetapan.standar');
            }
        } catch (\Exception $e) {

            Alert::success('error', 'Dokumen gagal dihapus.');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
