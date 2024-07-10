@extends('User.admin.Pelaksanaan.sidebar')
@section('content-dokumen')
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-purple">
                <tr>
                    <th style="padding-left: 25px">Nama Dokumen</th>
                    <th style="padding-left: 25px">Program Studi</th>
                    <th style="padding-left: 25px">Tanggal Terakhir Dilakukan</th>
                    <th style="padding-left: 25px">Tanggal Diperbarui</th>
                    <th style="padding-left: 30px">Unggahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                {{-- @foreach --}}
                <tr>
                    <td><i class="me-3"></i> Laporan Isian AMI</td>
                    <td><i class="me-3"></i>Pendidikan Bahasa dan Sastra Indonesia</td>
                    <td style="padding-left: 60px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 40px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 50px"><span class="badge bg-label-info me-1"><i
                                class="bi bi-link-45deg">file</i></span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i class="me-3"></i> Berkas Audit AMI</td>
                    <td><i class="me-3"></i>Pendidikan Guru Sekolah Dasar</td>
                    <td style="padding-left: 60px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 40px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 50px"><span class="badge bg-label-info me-1"><i
                                class="bi bi-link-45deg">file</i></span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i class="me-3"></i> Laporan Evaluasi Diri (LED)</td>
                    <td><i class="me-3"></i>Pendidikan Informatika</td>
                    <td style="padding-left: 60px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 40px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 50px"><span class="badge bg-label-info me-1"><i
                                class="bi bi-link-45deg">file</i></span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i class="me-3"></i> Laporan Evaluasi Diri (LED)</td>
                    <td><i class="me-3"></i>Pendidikan Guru Sekolah Dasar</td>
                    <td style="padding-left: 60px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 40px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 50px"><span class="badge bg-label-info me-1"><i
                                class="bi bi-link-45deg">file</i></span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i class="me-3"></i> Laporan Evaluasi Diri (LED)</td>
                    <td><i class="me-3"></i>Pendidikan Guru Pendidikan Anak Usia Dini</td>
                    <td style="padding-left: 60px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 40px"><i class="me-3"></i> yyyy/mm/dd</td>
                    <td style="padding-left: 50px"><span class="badge bg-label-info me-1"><i
                                class="bi bi-link-45deg">file</i></span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
    </div>
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('tambahTimJAMU') }}'">+
            Tambah Dokumen AMI</button>
        @if (session('success'))
            <div>{{ @session('success') }}</div>
        @endif
    </div>
@endsection
