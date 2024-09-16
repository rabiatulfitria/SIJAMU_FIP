@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center" style="color: #007bff; font-size: 20px; font-weight:bold">Evaluasi</div>

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
                                    <span class="fw-semibold d-block">John Doe</span>
                                    <small class="text-muted">Admin</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="auth-login-basic.html">
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
        <h5 class="card-header">Audit Mutu Internal (AMI)
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                Tahun Akademik (TA)
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);">2022-2023</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">2023-2024</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">2024-2025</a></li>
            </ul>
        </h5>
        <div class="table text-nowrap" id="horizontal-example">
            <table class="table table-bordered">
                <thead class="table-purple">
                    <tr>
                        <th>Nama Dokumen</th>
                        <th>Program Studi</th>
                        <th>Tanggal Terakhir Dilakukan</th>
                        <th>Tanggal Diperbarui</th>
                        <th>Unggahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($evaluasi as $row)
                    <tr>
                        <td><i></i>{{ $row->namaDokumen_evaluasi }}</td>
                        <td><i></i>{{ $row->program_studi }}</td>
                        <td><i></i>{{ $row->tanggal_terakhir_dilakukan }}</td>
                        <td><i></i>{{ $row->tanggal_diperbarui }}</td>
                        <td>
                            @php
                                $files = json_decode($row->unggahan_dokumen, true);
                            @endphp
                            
                            @if ($files && is_array($files))
                                @foreach ($files as $file)
                                    <a href="{{ route('dokumenevaluasi', ['id_evaluasi' => $row->id_evaluasi]) }}"
                                        class="badge bg-label-info me-1" target="_blank" >
                                        <i class="bi bi-link-45deg">Dokumen</i>
                                    </a>
                                @endforeach
                            @else
                                <p>Masih dalam proses</p>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <div>
                                        <a class="dropdown-item"
                                            href="{{ route('editDokumenEvaluasi', $row->id_evaluasi) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Ubah</a>
                                    </div>
                                    <div>
                                        <form method="POST"
                                            action="{{ route('hapusDokumenEvaluasi', $row->id_evaluasi) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item btn btn-outline-danger"><i
                                                    class="bx bx-trash me-1"></i>
                                                Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-light" onclick="window.location.href='{{ route('tambahDokumenAMI') }}'">+
            Tambah Dokumen AMI</button>
        @if (session('success'))
            <div>{{ @session('success') }}</div>
        @endif
    </div>
@endsection
