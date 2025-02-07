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
        // Mengambil data dari tabel standar_institusi beserta nama prodi dari tabel_prodi
        $dokumenp1 = DB::table('standar_institusi')
            ->join('penetapans', 'standar_institusi.id_penetapan', '=', 'penetapans.id_penetapan')
            ->join('tabel_prodi', 'standar_institusi.namaprodi', '=', 'tabel_prodi.id_prodi')
            ->select(
                'standar_institusi.id_standarinstitut',
                'tabel_prodi.nama_prodi as program_studi',
                'penetapans.tanggal_ditetapkan as tanggal_ditetapkan',
                'penetapans.id_penetapan as id_penetapan',
                'standar_institusi.namafile as nama_dokumenstandar',
                'standar_institusi.kategori as kategori',
                'standar_institusi.file as unggahan_dokumen' //unggahan_dokumen sebagai nama di $row
            )
            ->get();
        // foreach ($standar as $s) {
        //     $files = unserialize($s->files);
        // }
        return view('User.admin.Penetapan.standarinstitusi', compact('dokumenp1')); //compact(['standar', 'files'])
    }

    // public function uploadDokumen(Request $request)
    // {
    //     try {
    //         // Validasi input
    //         $validatedData = $request->validate([
    //             'id_penetapan' => 'required',
    //             'files.*' => 'nullable|mimes:doc,docx,xls,xlsx,pdf|max:5120', //Maksimum 5120 KB (5 MB)
    //         ]);

    //         // Dapatkan id_penetapan dari request
    //         $idPenetapan = $validatedData['id_penetapan'];

    //         // Cek apakah ada file baru yang diunggah
    //         if ($request->hasFile('files')) {
    //             $namaDokumen = [];
    //             foreach ($request->file('files') as $file) {
    //                 $namaFile = time() . '-' . $file->getClientOriginalName();
    //                 $file->storeAs('standar', $namaFile, 'public');
    //                 $namaDokumen[] = $namaFile;  // Simpan nama file di array
    //             }

    //             // Gabungkan nama file menjadi string
    //             if (!empty($namaDokumen)) {
    //                 $namaDokumen = implode(',', $namaDokumen);
    //             }

    //             // Update hanya kolom files di tabel FileP1 yang terkait dengan penetapan
    //             DB::table('file_p1')
    //                 ->join('penetapans', 'file_p1.id_fp1', '=', 'penetapans.id_fp1')
    //                 ->where('penetapans.id_penetapan', $idPenetapan)
    //                 ->update([
    //                     'file_p1.files' => $namaDokumen,
    //                     'file_p1.updated_at' => now(),
    //                 ]);

    //             // Tampilkan pesan sukses
    //             Alert::success('success', 'Dokumen berhasil diperbarui.');
    //             return redirect()->route('penetapan.standar');
    //         }

    //         // Jika tidak ada file yang diunggah, tetap kembalikan response
    //         Alert::info('info', 'Tidak ada file yang diunggah.');
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         // Menangkap semua error dan menampilkan pesan kesalahan
    //         Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }


    public function create() //tambah
    {
        $penetapans = DB::table('penetapans')->select('id_penetapan', 'tanggal_ditetapkan')->get();

        // Mengambil data nama_prodi dari tabel_prodi
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        // Mengirim data ke view
        return view('User.admin.Penetapan.tambah_standarspmi', compact('prodi', 'penetapans'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_dokumenstandar' => 'required|string|max:255', //nama dari models StandarInstitut
            'kategori' => 'required|string',
            'tanggal_ditetapkan' => 'nullable|date',
            'program_studi' => 'required|exists:tabel_prodi,id_prodi',
            'files' => 'required',
            'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:5120' //Maksimum 5120 KB (5 MB)
        ]);

        // Simpan data ke tabel penetapans menggunakan query builder
        $idPenetapan = DB::table('penetapans')->insertGetId([
            'tanggal_ditetapkan' => $validatedData['tanggal_ditetapkan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->file('files') as $file) {
                // Generate unique file name
                $namaFile = time() . '-' . $file->getClientOriginalName();

                // Store file in the 'public/standar' directory
                $path = $file->storeAs('standar', $namaFile, 'public');

                // Insert data into 'standar_institusi' table
                DB::table('standar_institusi')->insert([
                    'id_penetapan' => $idPenetapan,
                    'namafile' => $validatedData['nama_dokumenstandar'],
                    'kategori' => $validatedData['kategori'],
                    'namaprodi' => $validatedData['program_studi'],
                    'file' => $path,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();
            Alert::success('Selesai', 'Dokumen berhasil ditambahkan.');
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
                abort(404, 'File tidak ditemukan.');
            }
        }
    }

    public function edit(String $id)
    {
        // Ambil data standar_institusi yang ingin diedit
        $dokumenp1 = DB::table('standar_institusi')
            ->join('penetapans', 'standar_institusi.id_penetapan', '=', 'penetapans.id_penetapan')
            ->join('tabel_prodi', 'standar_institusi.namaprodi', '=', 'tabel_prodi.id_prodi')
            ->select(
                'standar_institusi.id_standarinstitut',
                'tabel_prodi.nama_prodi as program_studi',
                'penetapans.tanggal_ditetapkan as tanggal_ditetapkan',
                'penetapans.id_penetapan as id_penetapan',
                'standar_institusi.namafile as nama_dokumenstandar',
                'standar_institusi.kategori as kategori',
                'standar_institusi.file as unggahan_dokumen' //unggahan_dokumen sebagai nama di $row
            )
            ->where('standar_institusi.id_standarinstitut', '=', $id)
            //$id = variabel untuk nilai id_standarinstitut. Maka yang dipanggil pada route(web.php) adalah id
            ->first();

        // Ambil daftar program studi untuk dropdown
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        // Kirim data ke view
        return view('User.admin.Penetapan.edit_standarinstitusi', ['oldData' => $dokumenp1, 'prodi' => $prodi]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_dokumenstandar' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal_ditetapkan' => 'nullable|date',
            'program_studi' => 'required|exists:tabel_prodi,id_prodi',
            'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:5120' //Maksimum 5120 KB (5 MB)
        ]);

        try {
            DB::beginTransaction();

            // Ambil data lama dari tabel
            $dokumen = DB::table('standar_institusi')->where('id_standarinstitut', $id)->first();

            // Update tabel standar_institusi
            DB::table('standar_institusi')
                ->where('id_standarinstitut', $id)
                ->update([
                    'namafile' => $validatedData['nama_dokumenstandar'],
                    'kategori' => $validatedData['kategori'],
                    'namaprodi' => $validatedData['program_studi'],
                    'updated_at' => now()
                ]);

            // Update tabel penetapans
            DB::table('penetapans')->where('id_penetapan', $dokumen->id_penetapan)->update([
                'tanggal_ditetapkan' => $validatedData['tanggal_ditetapkan'],
                'updated_at' => now(),
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
                    DB::table('standar_institusi')
                        ->where('id_standarinstitut', $id)
                        ->update(['file' => $path]);
                }
            }

            DB::commit();
            Alert::success('Selesai', 'Dokumen berhasil diperbarui.');
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
            $dokumen = DB::table('standar_institusi')->where('id_standarinstitut', $id)->first();

            // Pastikan data dokumen ditemukan
            if ($dokumen) {
                // Hapus file dari storage
                if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                    Storage::delete('public/' . $dokumen->file);
                }

                // Hapus data dari tabel standar_institusi
                DB::table('standar_institusi')->where('id_standarinstitut', $id)->delete();


                Alert::success('Selesai', 'Dokumen berhasil dihapus.');
                return redirect()->route('penetapan.standar');
            } else {

                Alert::error('error', 'Dokumen gagal dihapus.');
                return redirect()->route('penetapan.standar');
            }
        } catch (\Exception $e) {

            Alert::error('error', 'Dokumen gagal dihapus.');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
