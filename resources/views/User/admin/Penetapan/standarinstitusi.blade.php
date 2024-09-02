@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center" style="color: #007bff; font-size: 20px; font-weight:bold">Penetapan</div>

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
        <h5 class="card-header">Standar Yang Ditetapkan Institusi</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-purple">
                    <tr>
                        <th>No</th>
                        <th style="padding-left: 10px">Nama Dokumen</th>
                        <th style="padding-left: 20px">Status Dokumen</th>
                        <th style="padding-left: 10px">Unggahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td class=" me-3" style="font-size: 13px">Standar Pendidikan Universitas Trunojoyo Madura</td>
                        {{-- @foreach ($standar as $item) --}}
                        <td>
                            <input name="status_dokumen" class="form-check-input" type="radio" value="Ada"
                                {{ $standar->status_dokumen == 'Ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio1">Ada</label>
                            <span></span>
                            <input name="status_dokumen" class="form-check-input" type="radio" value="Tidak Ada"
                                {{ $standar->status_dokumen == 'tidak ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio2">Tidak Ada</label>
                        </td>
                        <td>
                            @php
                                $files = json_decode($standar->files, true);
                            @endphp

                            @if ($files && is_array($files))
                                @foreach ($files as $file)
                                    <a href="{{ route('private', ['id_penetapan' => $standar->id_penetapan]) }}"
                                        class="badge bg-label-info me-1">
                                        <i class="bi bi-link-45deg">Dokumen</i>
                                    </a>
                                @endforeach
                            @else
                                <p>Masih dalam proses</p>
                            @endif
                        </td>

                        {{-- @endforeach --}}
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" type="button"
                                        onclick="window.location.href='{{ route('unggahDokumenStandar', ['id' => $standar->id_penetapan]) }}'"><i
                                            class="bx bx-upload"></i>
                                        Unggah Dokumen</a>
                                    @if (session('success'))
                                        <div>{{ @session('success') }}</div>
                                    @endif
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-edit-alt me-1"></i> Ubah Dokumen
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-edit-alt me-1"></i> Ubah Standar
                                    </a>
                                    <a class="dropdown-item btn btn-outline-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class=" me-3" style="font-size: 13px">Standar Penelitian Universitas Trunojoyo Madura</td>
                        {{-- @foreach ($standar as $item) --}}
                        <td>
                            <input name="status_dokumen2" class="form-check-input" type="radio" value="Ada"
                                {{ $standar2->status_dokumen == 'Ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio1">Ada</label>
                            <span></span>
                            <input name="status_dokumen2" class="form-check-input" type="radio" value="Tidak Ada"
                                {{ $standar2->status_dokumen == 'tidak ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio2">Tidak Ada</label>
                        </td>
                        <td>
                            @php
                                $files = json_decode($standar2->files, true);
                            @endphp

                            @if ($files && is_array($files))
                                @foreach ($files as $file)
                                    <a href="{{ route('private', ['id_penetapan' => $standar2->id_penetapan]) }}"
                                        class="badge bg-label-info me-1">
                                        <i class="bi bi-link-45deg">Dokumen</i>
                                    </a>
                                @endforeach
                            @else
                                <p>Masih dalam proses</p>
                            @endif
                        </td>
                        {{-- @endforeach --}}
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" type="button"
                                        onclick="window.location.href='{{ route('unggahDokumenStandar', ['id' => $standar->id_penetapan]) }}'"><i
                                            class="bx bx-upload"></i>
                                        Unggah Dokumen</a>
                                    @if (session('success'))
                                        <div>{{ @session('success') }}</div>
                                    @endif
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Ubah Dokumen
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-edit-alt me-1"></i> Ubah Standar
                                    </a>
                                    <a class="dropdown-item btn btn-outline-danger" href="javascript:void(0);"><i
                                            class="bx bx-trash me-1"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class=" me-3" style="font-size: 13px">Standar Pengabdian Kepada Masyarakat Universitas
                            Trunojoyo Madura</td>
                        {{-- @foreach ($standar as $item) --}}
                        <td>
                            <input name="status_dokumen3" class="form-check-input" type="radio" value="Ada"
                                {{ $standar3->status_dokumen == 'Ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio1"> Ada</label>
                            <span></span>
                            <input name="status_dokumen3" class="form-check-input" type="radio" value="Ada"
                                {{ $standar3->status_dokumen == 'tidak Ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio2"> Tidak Ada</label>
                        </td>
                        </td>
                        <td>
                            @php
                                $files = json_decode($standar3->files, true);
                            @endphp

                            @if ($files && is_array($files))
                                @foreach ($files as $file)
                                    <a href="{{ route('private', ['id_penetapan' => $standar2->id_penetapan]) }}"
                                        class="badge bg-label-info me-1">
                                        <i class="bi bi-link-45deg">Dokumen</i>
                                    </a>
                                @endforeach
                            @else
                                <p>Masih dalam proses</p>
                            @endif
                        </td>
                        {{-- @endforeach --}}
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" type="button"
                                        onclick="window.location.href='{{ route('unggahDokumenStandar', ['id' => $standar->id_penetapan]) }}'"><i
                                            class="bx bx-upload"></i>
                                        Unggah Dokumen</a>
                                    @if (session('success'))
                                        <div>{{ @session('success') }}</div>
                                    @endif
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Ubah Dokumen
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-edit-alt me-1"></i> Ubah Standar
                                    </a>
                                    <a class="dropdown-item btn btn-outline-danger" href="javascript:void(0);"><i
                                            class="bx bx-trash me-1"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class=" me-3" style="font-size: 13px">Standar di aspek lainnya</td>
                    </tr>
                    @foreach ($standar4 as $item)
                        <tr>
                            <td></td>
                            <td>
                                <li class="me-3" style="font-size: 13px">
                                    Standar Layanan Kemahasiswaan Universitas Trunojoyo Madura
                                </li>
                            </td>
                            <td>
                                <input name="status_dokumen4" class="form-check-input" type="radio" value="Ada"
                                    {{ $item->status_dokumen == 'Ada' ? 'checked' : '' }} />
                                <label class="form-check-label" for="defaultRadio1"> Ada</label>
                                <span></span>
                                <input name="status_dokumen4" class="form-check-input" type="radio" value="Tidak Ada"
                                    {{ $item->status_dokumen == 'Tidak Ada' ? 'checked' : '' }} />
                                <label class="form-check-label" for="defaultRadio2"> Tidak Ada</label>
                            </td>
                            <td>
                                @php
                                    $files = json_decode($item->files, true);
                                @endphp

                                @if ($files && is_array($files))
                                    @foreach ($files as $file)
                                        <a href="{{ route('private', ['id_penetapan' => $item->id_penetapan]) }}"
                                            class="badge bg-label-info me-1">
                                            <i class="bi bi-link-45deg">Dokumen</i>
                                        </a>
                                    @endforeach
                                @else
                                    <p>Masih dalam proses</p>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" type="button"
                                            onclick="window.location.href='{{ route('unggahDokumenStandar', ['id' => $standar->id_penetapan]) }}'">
                                            <i class="bx bx-upload"></i> Unggah Dokumen
                                        </a>
                                        @if (session('success'))
                                            <div>{{ @session('success') }}</div>
                                        @endif
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-edit-alt me-1"></i> Ubah Dokumen
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-edit-alt me-1"></i> Ubah Standar
                                        </a>
                                        <a class="dropdown-item btn btn-outline-danger" href="javascript:void(0);">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                        </a>
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
        <button type="button" class="btn btn-light" onclick="window.location.href='{{ route('tambahStandar') }}'">+
            Tambah Standar</button>
        @if (session('success'))
            <div>{{ @session('success') }}</div>
        @endif
    </div>
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-light"
            onclick="window.location.href='{{ route('FolderDokumenStandar') }}'">Folder
        </button>
    </div>
@endsection
