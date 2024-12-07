@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-items d-flex align-item-center">Edit Dokumen Pelaksanaan</div>
        </div>
    @endsection

    @section('content')
        <div class="row">

            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('update-dokumen-pelaksanaan/' . $pelaksanaan->id) }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Nama Dokumen -->
                            <div class="mb-3">
                                <label class="form-label" for="bx bx-file">Nama Dokumen</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-file"></i></span>
                                    <input type="text" class="form-control" id="bx bx-file" name="nama_filep1" placeholder="Nama Dokumen" required
                                           value="{{ $pelaksanaan->namafile }}" />
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Renstra Program Studi" {{ $pelaksanaan->kategori == 'Renstra Program Studi' ? 'selected' : '' }}>Renstra Program Studi</option>
                                    <option value="Laporan Kinerja Program Studi" {{ $pelaksanaan->kategori == 'Laporan Kinerja Program Studi' ? 'selected' : '' }}>Laporan Kinerja Program Studi</option>
                                    <option value="Dokumen Kurikulum" {{ $pelaksanaan->kategori == 'Dokumen Kurikulum' ? 'selected' : '' }}>Dokumen Kurikulum</option>
                                    <option value="Rencana Pembelajaran Semester (RPS)" {{ $pelaksanaan->kategori == 'Rencana Pembelajaran Semester (RPS)' ? 'selected' : '' }}>Rencana Pembelajaran Semester (RPS)</option>
                                    <option value="Dokumen Monitoring dan Evaluasi Kegiatan Program MBKM" {{ $pelaksanaan->kategori == 'Dokumen Monitoring dan Evaluasi Kegiatan Program MBKM' ? 'selected' : '' }}>Dokumen Monitoring dan Evaluasi Kegiatan Program MBKM</option>
                                    <option value="Capaian Pembelajaran Lulusan (CPL)" {{ $pelaksanaan->kategori == 'Capaian Pembelajaran Lulusan (CPL)' ? 'selected' : '' }}>Capaian Pembelajaran Lulusan (CPL)</option>
                                    <option value="Panduan RPS" {{ $pelaksanaan->kategori == 'Panduan RPS' ? 'selected' : '' }}>Panduan RPS</option>
                                    <option value="Panduan Mutu Soal" {{ $pelaksanaan->kategori == 'Panduan Mutu Soal' ? 'selected' : '' }}>Panduan Mutu Soal</option>
                                    <option value="Panduan Kisi Kisi Soal" {{ $pelaksanaan->kategori == 'Panduan Kisi Kisi Soal' ? 'selected' : '' }}>Panduan Kisi Kisi Soal</option>
                                    <option value="Formulir Kepuasan Mahasiswa" {{ $pelaksanaan->kategori == 'Formulir Kepuasan Mahasiswa' ? 'selected' : '' }}>Formulir Kepuasan Mahasiswa</option>
                                    <option value="Dokumen Monitoring dan Evaluasi Ketercapaian Standar Layanan Kemahasiswaan" {{ $pelaksanaan->kategori == 'Dokumen Monitoring dan Evaluasi Ketercapaian Standar Layanan Kemahasiswaan' ? 'selected' : '' }}>Dokumen Monitoring dan Evaluasi Ketercapaian Standar Layanan Kemahasiswaan</option>
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" required min="1900" max="2099"
                                       value="{{ $pelaksanaan->tahun }}" />
                            </div>

                            <!-- Nama Program Studi -->
                            <div class="mb-3">
                                <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                                <select class="form-select" id="nama_prodi" name="nama_prodi" required>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($prodi as $item)
                                        <option value="{{ $item->id_prodi }}" {{ $pelaksanaan->namaprodi == $item->id_prodi ? 'selected' : '' }}>
                                            {{ $item->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Dokumen -->
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Pilih Dokumen</label>
                                <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple />
                                <p class="form-text text-muted">Unggah ulang dokumen jika ingin mengubah file yang sudah ada.</p>
                                <p class="form-text" style="color: #7ebcfe">Maksimum 5120 KB (5 MB)</p>
                            </div>

                            <!-- Kirim -->
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
