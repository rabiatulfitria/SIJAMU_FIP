<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class pelaksanaan1Controller extends Controller
{
    public function index()
    {
        $renstraProgramStudi = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Renstra Program Studi')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $laporanKinerjaProgramStudi = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Laporan Kinerja Program Studi')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $dokumenKurikulum = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Dokumen Kurikulum')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $rps = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Rencana Pembelajaran Semester (RPS)')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $monitoringMbkm = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Dokumen Monitoring dan Evaluasi Kegiatan Program MBKM')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $cpl = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Capaian Pembelajaran Lulusan (CPL)')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $panduanRps = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Panduan RPS')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $panduanMutuSoal = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Panduan Mutu Soal')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $panduanKisiKisi = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Panduan Kisi Kisi Soal')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $formulirKepuasan = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Formulir Kepuasan Mahasiswa')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        $monitoringKemahasiswaan = DB::table('pelaksanaan_prodi')
                        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
                        ->where('pelaksanaan_prodi.kategori', 'Dokumen Monitoring dan Evaluasi Ketercapaian Standar Layanan Kemahasiswaan')
                        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
                        ->get();

        return view('User.admin.Pelaksanaan.index_prodi', compact(
            'renstraProgramStudi',
            'laporanKinerjaProgramStudi',
            'dokumenKurikulum',
            'rps',
            'monitoringMbkm',
            'cpl',
            'panduanRps',
            'panduanMutuSoal',
            'panduanKisiKisi',
            'formulirKepuasan',
            'monitoringKemahasiswaan'
        ));
    }


    public function tambahPelaksanaan() {
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        return view('User.admin.Pelaksanaan.tambah_dokumen_pelaksanaan', compact('prodi'));
    }

    public function simpanPelaksanaan(Request $request)
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

                    // Store file in the 'public/pelaksanaan' directory
                    $path = $file->storeAs('pelaksanaan', $namaDokumen, 'public');

                    // Insert data into 'pelaksanaan_prodi' table
                    DB::table('pelaksanaan_prodi')->insert([
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
                return redirect()->route('pelaksanaan.prodi');
            } catch (\Exception $e) {
                DB::rollBack();
                Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }
    }

    public function editPelaksanaan(Request $request, $id){
        // Ambil data pelaksanaan_prodi yang ingin diedit
        $pelaksanaan = DB::table('pelaksanaan_prodi')
        ->join('tabel_prodi', 'pelaksanaan_prodi.namaprodi', '=', 'tabel_prodi.id_prodi')
        ->select('pelaksanaan_prodi.*', 'tabel_prodi.nama_prodi')
        ->where('pelaksanaan_prodi.id', '=', $id)
        ->first();

        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        return view('User.admin.Pelaksanaan.edit_dokumen_pelaksanaan', compact('pelaksanaan','prodi'));
    }

    public function updatePelaksanaan(Request $request, $id)
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
            $dokumen = DB::table('pelaksanaan_prodi')->where('id', $id)->first();

            // Update data di database
            DB::table('pelaksanaan_prodi')
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
                    $path = $file->storeAs('pelaksanaan', $namaFile, 'public');

                    // Update path file baru di database
                    DB::table('pelaksanaan_prodi')
                        ->where('id', $id)
                        ->update(['file' => $path]);
                }
            }

            DB::commit();
            Alert::success('success', 'Dokumen berhasil diupdate.');
            return redirect()->route('pelaksanaan.prodi');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function deletePelaksanaan(String $id)
    {
        try {
            // Ambil data dokumen berdasarkan id
            $dokumen = DB::table('pelaksanaan_prodi')->where('id', $id)->first();

            // Pastikan data dokumen ditemukan
            if ($dokumen) {
                // Hapus file dari storage
                if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                    Storage::delete('public/' . $dokumen->file);
                }

                // Hapus data dari tabel pelaksanaan_prodi
                DB::table('pelaksanaan_prodi')->where('id', $id)->delete();


                Alert::success('success', 'Dokumen berhasil dihapus.');
                return redirect()->route('pelaksanaan.prodi');
            } else {

                Alert::success('error', 'Dokumen gagal dihapus.');
                return redirect()->route('pelaksanaan.prodi');
            }
        } catch (\Exception $e) {

            Alert::success('error', 'Dokumen gagal dihapus.');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function indexFakultas()
    {
        $renstraFakultas = DB::table('pelaksanaan_fakultas')
                        ->where('kategori', 'Renstra Fakultas')
                        ->get();

        $laporanKinerjaFakultas = DB::table('pelaksanaan_fakultas')
                        ->where('kategori', 'Laporan Kinerja Fakultas')
                        ->get();

        return view('User.admin.Pelaksanaan.index_fakultas', compact(
            'renstraFakultas',
            'laporanKinerjaFakultas'
        ));
    }

    public function tambahPelaksanaanFakultas() {
        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        return view('User.admin.Pelaksanaan.tambah_dokumen_pelaksanaan_fakultas', compact('prodi'));
    }

    public function simpanPelaksanaanFakultas(Request $request)
    {
        {
            $request->validate([
                'nama_filep1' => 'required|string|max:255',
                'kategori' => 'required|string',
                'tahun' => 'required|numeric|min:1900|max:2099',
                'files' => 'required',
                'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:2048'
            ]);

            try {
                DB::beginTransaction();

                foreach ($request->file('files') as $file) {
                    // Generate unique file name
                    $namaDokumen = time() . '-' . $file->getClientOriginalName();

                    // Store file in the 'public/pelaksanaan' directory
                    $path = $file->storeAs('pelaksanaan', $namaDokumen, 'public');

                    // Insert data into 'pelaksanaan_fakultas' table
                    DB::table('pelaksanaan_fakultas')->insert([
                        'namafile' => $request->nama_filep1,
                        'kategori' => $request->kategori,
                        'tahun' => $request->tahun,
                        'file' => $path,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

                DB::commit();
                Alert::success('success', 'Dokumen berhasil ditambahkan.');
                return redirect()->route('pelaksanaan.fakultas');
            } catch (\Exception $e) {
                DB::rollBack();
                Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }
    }

    public function editPelaksanaanFakultas(Request $request, $id){
        // Ambil data pelaksanaan_fakultas yang ingin diedit
        $pelaksanaan = DB::table('pelaksanaan_fakultas')
        ->where('id', '=', $id)
        ->first();

        $prodi = DB::table('tabel_prodi')->select('id_prodi', 'nama_prodi')->get();

        return view('User.admin.Pelaksanaan.edit_dokumen_pelaksanaan_fakultas', compact('pelaksanaan','prodi'));
    }

    public function updatePelaksanaanFakultas(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_filep1' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tahun' => 'required|numeric|min:1900|max:2099',
            'files.*' => 'file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            // Ambil data lama dari tabel
            $dokumen = DB::table('pelaksanaan_fakultas')->where('id', $id)->first();

            // Update data di database
            DB::table('pelaksanaan_fakultas')
                ->where('id', $id)
                ->update([
                    'namafile' => $request->nama_filep1,
                    'kategori' => $request->kategori,
                    'tahun' => $request->tahun,
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
                    $path = $file->storeAs('pelaksanaan', $namaFile, 'public');

                    // Update path file baru di database
                    DB::table('pelaksanaan_fakultas')
                        ->where('id', $id)
                        ->update(['file' => $path]);
                }
            }

            DB::commit();
            Alert::success('success', 'Dokumen berhasil diupdate.');
            return redirect()->route('pelaksanaan.fakultas');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function deletePelaksanaanFakultas(String $id)
    {
        try {
            // Ambil data dokumen berdasarkan id
            $dokumen = DB::table('pelaksanaan_fakultas')->where('id', $id)->first();

            // Pastikan data dokumen ditemukan
            if ($dokumen) {
                // Hapus file dari storage
                if ($dokumen->file && Storage::exists('public/' . $dokumen->file)) {
                    Storage::delete('public/' . $dokumen->file);
                }

                // Hapus data dari tabel pelaksanaan_fakultas
                DB::table('pelaksanaan_fakultas')->where('id', $id)->delete();


                Alert::success('success', 'Dokumen berhasil dihapus.');
                return redirect()->route('pelaksanaan.fakultas');
            } else {

                Alert::success('error', 'Dokumen gagal dihapus.');
                return redirect()->route('pelaksanaan.fakultas');
            }
        } catch (\Exception $e) {

            Alert::success('error', 'Dokumen gagal dihapus.');
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
