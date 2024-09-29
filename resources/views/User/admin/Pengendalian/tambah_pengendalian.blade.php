@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-items d-flex align-item-center">Tambah Dokumen Pengendalian</div>
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
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label" for="">Nama Dokumen</label>
                            <select class="form-select" id="namaDokumen_evaluasi" name="namaDokumen_evaluasi" required
                                onchange="toggleManualInput()">
                                <option value="" disabled selected>Pilih Nama Dokumen</option>
                                <option value="Standar Pendidikan">Standar Pendidikan Universitas Trunojoyo Madura</option>
                                <option value="Standar Penelitian">Standar Penelitian Universitas Trunojoyo Madura</option>
                                <option value="Standar Pengabdian">Standar Pengabdian Kepada Masyarakat Universitas Trunojoyo Madura</option>
                                <option value="Standar ">Standar Penelitian Universitas Trunojoyo Madura</option>

                            </select>
                            <div class="mb-3">
                                <label class="form-label" for="">Program Studi</label>
                                <select class="form-select" id="program_studi" name="program_studi" required>
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                    <option value="Pendidikan Bahasa dan Sastra Indonesia">Pendidikan Bahasa dan Sastra
                                        Indonesia
                                    </option>
                                    <option value="Pendidikan Informatika">Pendidikan Guru Sekolah Dasar</option>
                                    <option value="Pendidikan Ilmu Pengetahuan Alam">Pendidikan Ilmu Pengetahuan Alam
                                    </option>
                                    <option value="Pendidikan Guru Pendidikan Anak Usia Dini">Pendidikan Guru Pendidikan
                                        Anak Usia Dini</option>
                                    <option value="Pendidikan Informatika">Pendidikan Informatika</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="">Tanggal Terakhir Dilakukan</label>
                                <input type="date" class="form-control" id="tanggal_terakhir_dilakukan"
                                    name="tanggal_terakhir_dilakukan" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="">Tanggal Diperbarui</label>
                                <input type="date" class="form-control" id="tanggal_diperbarui"
                                    name="tanggal_diperbarui" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="formFileMultiple">Unggah Dokumen</label>
                                <input type="file" class="form-control" id="formFileMultiple" multiple
                                    name="unggahan_dokumen[]" />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">{{ isset($evaluasi) }}Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection