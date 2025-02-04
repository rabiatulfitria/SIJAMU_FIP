<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\pelaksanaan_fakultas;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\ModelNotFoundException;


// use Illuminate\Http\Request;

class pelaksanaan2Controller extends Controller
{
    // public function index()
    // {
    //     return view('User.admin.Pelaksanaan.index_fakultas');
    // }

    // public function fakultas(){
    //     //mengambil data dari database melalui model Pelaksanaan dan mengembalikannya dalam format JSON(teks).
    //     $data=pelaksanaan_fakultas::all();
    //     return response()->json(['pelaksanaan_fakultas'=>$data]);
    // }
    public function indexFakultas()
    {
        $plks_fakultas = pelaksanaan_fakultas::with('kategori')
            ->whereHas('kategori', function ($query) {
                $query->whereIn('nama_kategori', [
                    'Renstra Fakultas',
                    'Laporan Kinerja Fakultas',
                ]);
            })
            ->get();

        $renstraFakultas = $plks_fakultas->filter(function ($item) {
            return $item->kategori->nama_kategori === 'Renstra Fakultas';
        });

        $laporanKinerjaFakultas = $plks_fakultas->filter(function ($item) {
            return $item->kategori->nama_kategori === 'Laporan Kinerja Fakultas';
        });

        return view('User.admin.Pelaksanaan.index_fakultas', compact(
            'renstraFakultas',
            'laporanKinerjaFakultas'
        ));
    }


    public function tambahPelaksanaanFakultas()
    {
        $prodi = Prodi::select('id_prodi', 'nama_prodi')->get();
        $kategori = kategori::select('id_kategori', 'nama_kategori')->get();

        return view('User.admin.Pelaksanaan.tambah_dokumen_pelaksanaan_fakultas', compact('prodi', 'kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'namafile' => 'required|string|max:255',
            'nama_kategori' => 'required|exists:kategori,id_kategori',
            'periode_tahunakademik' => 'required|string|max:255',
            'file' => 'required',
            'file.*' => 'file|mimes:pdf,doc,docx,xlsx,url|max:5120' // Maksimum 5 MB
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->file('file') as $file) {
                // Generate unique file name
                $namaDokumen = time() . '-' . $file->getClientOriginalName();

                // Simpan file ke direktori 'public/pelaksanaan/fakultas'
                $path = $file->storeAs('pelaksanaan/fakultas', $namaDokumen, 'public');

                // Simpan data ke tabel 'pelaksanaan_fakultas' menggunakan Eloquent
                pelaksanaan_fakultas::create([
                    'namafile' => $validatedData['namafile'],
                    'periode_tahunakademik' => $validatedData['periode_tahunakademik'],
                    'nama_kategori' => $validatedData['nama_kategori'],
                    'file' => $path,
                ]);
            }

            DB::commit();
            Alert::success('Selesai', 'Dokumen berhasil ditambahkan.');
            return redirect()->route('pelaksanaan.fakultas');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function lihatdokumenPlksFakultas($id_plks_fklts)
    {
        $plks_fklts = pelaksanaan_fakultas::findOrFail($id_plks_fklts);
        $filePaths = json_decode($plks_fklts->file, true);

        if (is_array($filePaths) && !empty($filePaths)) {
            $file = $filePaths[0];

            if (Storage::disk('local')->exists($file)) {
                return response()->file(storage_path('app' . $file));
            } else {
                abort(404, 'File tidak ditemukan.');
            }
        }
    }

    public function editPelaksanaanFakultas(String $id_plks_fklts)
    {
        // Ambil data pelaksanaan_fakultas yang ingin diedit menggunakan Eloquent
        $pelaksanaanfakultas = pelaksanaan_fakultas::with('kategori')
            ->where('id_plks_fklts', $id_plks_fklts)
            ->firstOrFail(); // Ambil data atau lemparkan 404 jika tidak ditemukan

        // Ambil daftar kategori menggunakan Eloquent
        $kategori = Kategori::select('id_kategori', 'nama_kategori')->get();

        // Return ke view dengan data yang telah diambil
        return view('User.admin.Pelaksanaan.edit_dokumen_pelaksanaan_fakultas', [
            'oldData' => $pelaksanaanfakultas,
            'kategori' => $kategori
        ]);
    }

    public function updatePelaksanaanFakultas(Request $request, $id_plks_fklts)
    {
        // Validasi input
        $validatedData = $request->validate([
            'namafile' => 'required|string|max:255',
            'nama_kategori' => 'required|exists:kategori,id_kategori',
            'periode_tahunakademik' => 'required|string|max:255',
            'file' => 'required',
            'file.*' => 'file|mimes:pdf,doc,docx,xlsx,url|max:5120' // Maksimum 5 MB
        ]);

        try {
            DB::beginTransaction();

            // Ambil data lama dari database
            $dokumen = pelaksanaan_fakultas::findOrFail($id_plks_fklts);

            // Update data pelaksanaan_fakultas
            $dokumen->update([
                'namafile' => $validatedData['namafile'],
                'periode_tahunakademik' => $validatedData['periode_tahunakademik'],
                'nama_kategori' => $validatedData['nama_kategori'],
                'updated_at' => now(),
            ]);

            // Jika ada file baru diunggah
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Hapus file lama jika ada
                    if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                        Storage::delete('public/' . $dokumen->file);
                    }

                    // Generate nama file unik
                    $namaFile = time() . '-' . $file->getClientOriginalName();
                    $path = $file->storeAs('pelaksanaan/fakultas', $namaFile, 'public');

                    // Update path file baru di database
                    $dokumen->update(['file' => $path]);
                }
            }

            DB::commit();
            Alert::success('Selesai', 'Dokumen berhasil diupdate.');
            return redirect()->route('pelaksanaan.fakultas');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function deletePelaksanaanFakultas(String $id_plks_fklts)
    {
        try {
            // Ambil data dokumen berdasarkan ID
            $dokumen = pelaksanaan_fakultas::findOrFail($id_plks_fklts);

            // Hapus file dari storage jika ada
            if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                Storage::delete('public/' . $dokumen->file);
            }

            // Hapus data dari database
            $dokumen->delete();

            Alert::success('Selesai', 'Dokumen berhasil dihapus.');
            return redirect()->route('pelaksanaan.fakultas');
        } catch (ModelNotFoundException $e) {
            Alert::error('error', 'Dokumen tidak ditemukan.');
            return redirect()->route('pelaksanaan.fakultas');
        } catch (\Exception $e) {
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Dokumen gagal dihapus.');
        }
    }
}
