@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-xl-0 d-xl-none me-3">
        <a class="nav-item nav-link me-xl-4 px-0" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center" style="color: #007bff; font-size: 20px; font-weight:bold">Penetapan</div>

        <ul class="navbar-nav align-items-center ms-auto flex-row">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt
                            class="w-px-40 rounded-circle h-auto" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="me-3 flex-shrink-0">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 rounded-circle h-auto" />
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
                        <a class="dropdown-item" href="{{route('logout')}}">
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
        <h5 class="card-header">Standar Yang Ditetapkan Institusi</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-purple">
                    <tr>
                        <th style="padding-left: 35px">Nama Dokumen</th>
                        <th style="padding-left: 35px">Kategori</th>
                        <th style="padding-left: 35px">Tahun</th>
                        <th style="padding-left: 35px">Nama Program Studi</th>
                        <th style="padding-left: 10px">Unggahan</th>
                        @if(Auth::user() && (Auth::user()->level == 'Admin' || Auth::user()->level == 'Jaminan Mutu' || Auth::user()->level == 'Koorprodi'))
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($dokumenp1 as $row)
                        <tr>
                            <td style="padding-left: 20px"><i class="me-3"></i>
                                <strong>{{ $row->namafile }}</strong>
                            </td>
                            <td>{{ $row->kategori }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>{{ $row->nama_prodi }}</td>
                            <td>
                                @if ($row->file)
                                    <!-- Link ke dokumen -->
                                    <a href="{{ asset('storage/' . $row->file) }}" class="badge bg-label-info me-1" target="_blank">
                                        <i class="bi bi-link-45deg">Dokumen</i>
                                    </a>
                                @else
                                    <p>Masih dalam proses</p>
                                @endif
                            </td>
                            @if(Auth::user() && (Auth::user()->level == 'Admin' || Auth::user()->level == 'Jaminan Mutu' || Auth::user()->level == 'Koorprodi'))
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if (session('success'))
                                            <div>{{ @session('success') }}</div>
                                        @endif
                                        <a class="dropdown-item"
                                            onclick="window.location.href='{{ route('editDataStandar', ['id' => $row->id_standarinstitut]) }}'">
                                            <i class="bx bx-edit-alt me-1"></i> Ubah Data
                                        </a>
                                        <div>
                                            <form method="POST"
                                                action="{{ route('hapusDokumenStandar', $row->id_standarinstitut) }}">
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
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if(Auth::user() && (Auth::user()->level == 'Admin' || Auth::user()->level == 'Jaminan Mutu' || Auth::user()->level == 'Koorprodi'))
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-light" onclick="window.location.href='{{ route('tambahStandar') }}'">
            + Tambah Standar
        </button>
        @if (session('success'))
            <div>{{ @session('success') }}</div>
        @endif
    </div>
    @endif
@endsection
