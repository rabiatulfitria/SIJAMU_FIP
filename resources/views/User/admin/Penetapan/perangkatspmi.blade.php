@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center" style="color: #007bff; font-size: 20px; font-weight:bold">Penetapan</div>

        {{-- <small class="text-gray fw-semibold">Perangkat SPMI</small> --}}
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt
                            class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <!-- Tampilkan nama pengguna -->
                                    <span class="fw-semibold d-block">{{ Auth::User()->nama }}</span>
                                    <!-- Tampilkan role atau informasi tambahan jika perlu -->
                                    <small class="text-muted">{{ Auth::User()->role->role_name }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--<li>-->
                    <!--    <div class="dropdown-divider"></div>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <a class="dropdown-item" href="#">-->
                    <!--        <i class="bx bx-user me-2"></i>-->
                    <!--        <span class="align-middle">Profil Pengguna</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Dokumen SPMI</h5> {{-- Dokumen SPMI (Perangkat SPMI) --}}
        <div class="table-responsive text-nowrap">
            <table class="table custom-table-sm dataTables_paginate .paginate_button" id="Datatable">
                <thead class="table-purple">
                    <tr>
                        <th>Nama Dokumen</th>
                        <th>Kategori</th>
                        <th>Tanggal Ditetapkan</th>
                        {{-- <th>Nama Program Studi</th> --}}
                        <th>Unggahan</th>
                        @if (Auth::user() &&
                                (Auth::user()->role->role_name == 'Admin' ||
                                    Auth::user()->role->role_name == 'JMF' ||
                                    Auth::user()->role->role_name == 'Ketua Jurusan' ||
                                    Auth::user()->role->role_name == 'Koordinator Prodi'))
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($dokumenp1 as $row)
                        <tr>
                            <td>{{ $row->nama_dokumenspmi }}</td>
                            <td>{{ $row->kategori }}</td>
                            <td>{{ $row->tanggal_ditetapkan }}</td>
                            {{-- <td>{{ $row->nama_prodi }}</td> --}}
                            <td>
                                @if ($row->unggahan_dokumen)
                                    <!-- Link ke dokumen -->
                                    <a href="{{ asset('storage/' . $row->unggahan_dokumen) }}"
                                        class="badge bg-label-info me-1" target="_blank">
                                        <i class="bi bi-link-45deg">Buka Dokumen</i>
                                    </a>
                                @else
                                    <p>Masih dalam proses</p>
                                @endif
                            </td>
                            @if (
                                (Auth::user() && Auth::user()->role->role_name == 'Admin') ||
                                    Auth::user()->role->role_name == 'JMF' ||
                                    Auth::user()->role->role_name == 'Ketua Jurusan' ||
                                    Auth::user()->role->role_name == 'Koordinator Prodi')
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <div>
                                                <a class="dropdown-item"
                                                    href="{{ route('editDokumenPerangkat', $row->id_dokspmi) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Ubah</a>
                                            </div>
                                            <div>
                                                <form id="delete-form-{{ $row->id_dokspmi }}" method="POST"
                                                    action="{{ route('hapusDokumenPerangkat', $row->id_dokspmi) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item btn btn-outline-danger"
                                                        onclick="confirmDelete({{ $row->id_dokspmi }})"><i
                                                            class="bx bx-trash me-1"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if (Auth::user() &&
            (Auth::user()->role->role_name == 'Admin' ||
                Auth::user()->role->role_name == 'JMF' ||
                Auth::user()->role->role_name == 'Ketua Jurusan' ||
                Auth::user()->role->role_name == 'Koordinator Prodi'))
        <div class="demo-inline-spacing">
            <button type="button" class="btn btn-light"
                onclick="window.location.href='{{ route('tambahDokumenPerangkat') }}'">+ Tambah Dokumen
            </button>
            @if (session('success'))
                <div>{{ @session('success') }}</div>
            @endif
        </div>
    @endif
@endsection
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Datatable').DataTable({
            "language": {
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                },
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri"
            }
        });
    });
</script>

<style>
    /* Custom CSS for DataTable */
    /* table.dataTable td,
    table.dataTable th {
        padding: 12px 15px;
    } */

    /* Pastikan semua teks di tabel DataTable rata kiri */
    .dataTable th,
    .dataTable td {
        text-align: left !important;
        padding: 12px 15px !important;
        /* Padding header dan data */
        vertical-align: middle;
        /* Teks sejajar secara vertikal */
    }

    .dataTables_wrapper {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(197, 100, 165, 0.1);
    }

    /* Mengubah tampilan pagination DataTable */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #4CAF50;
        /* Warna latar belakang */
        color: rgb(194, 108, 247);
        /* Warna teks */
        border: 1px solid #4CAF50;
        /* Warna border */
        padding: 6px 12px;
        /* Ukuran padding tombol */
        margin: 2px;
        border-radius: 5px;
        /* Membuat sudut tombol membulat */
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        /* Transisi warna */
    }

    /* Mengubah tampilan saat tombol pagination di-hover */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #45a049;
        /* Warna latar belakang saat di-hover */
        color: white;
        /* Warna teks */
        border-color: #45a049;
        /* Warna border saat di-hover */
    }

    /* Mengubah tampilan pagination aktif */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #2196F3;
        /* Warna latar belakang tombol aktif */
        color: white;
        /* Warna teks tombol aktif */
        border: 1px solid #2196F3;
        /* Warna border tombol aktif */
        border-radius: 5px;
        /* Membuat sudut tombol membulat */
    }

    /* Mengubah tampilan tombol pagination tidak aktif */
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        background-color: #cccccc;
        /* Warna latar belakang tombol tidak aktif */
        color: #666666;
        /* Warna teks tombol tidak aktif */
        border: 1px solid #cccccc;
        /* Warna border tombol tidak aktif */
        cursor: not-allowed;
        /* Cursor tidak diizinkan */
    }
</style>
