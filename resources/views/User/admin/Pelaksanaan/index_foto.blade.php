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
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1info">Info 1</div>
                <div class="tab-pane fade" id="tab2info">Info 2</div>
            </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-purple">
                    <tr>
                        <th>No</th>
                        <th style="padding-left: 20px">Nama Dokumen</th>
                        <th style="padding-left: 30px">Status Dokumen</th>
                        <th style="padding-left: 30px">Tautan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    {{-- @foreach --}}
                    <tr>
                        <td>1</td>
                        <td class="fab me-3" style="font-size: 13px">Standar Pendidikan Universitas Trunojoyo Madura</td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak Ada
                        </td>
                        <td><span class="badge bg-label-info me-1"><i class="bi bi-link-45deg">Dokumen</i></span></td>
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
                        <td>2</td>
                        <td class="fab me-3" style="font-size: 13px">Standar Penelitian Universitas Trunojoyo Madura</td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak Ada
                        </td>
                        <td><span class="badge bg-label-info me-1">Dokumen</span></td>
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
                        <td>3</td>
                        <td class="fab me-3" style="font-size: 13px">Standar Pengabdian Kepada Masyarakat Universitas Trunojoyo Madura</td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak
                            Ada
                        </td>
                        <td><span class="badge bg-label-info me-1">Dokumen</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="fab me-3" style="font-size: 13px">Standar di aspek lainnya</td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak
                            Ada
                        </td>
                        <td><span class="badge bg-label-info me-1">Dokumen</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <li class="fab me-3" style="font-size: 13px">Standar Layanan Kemahasiswaan Universitas Trunojoyo Madura</li>
                        </td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak
                            Ada
                        </td>
                        <td><span class="badge bg-label-info me-1">Dokumen</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <li class="fab me-3" style="font-size: 13px">Standar Layanan Kerjasama Universitas Trunoojoyo Madura</li>
                        </td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak
                            Ada
                        </td>
                        <td><span class="badge bg-label-info me-1">Dokumen</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <li class="fab me-3" style="font-size: 13px">Standar Tata Kelola Universitas Trunojoyo Madura</li>
                        </td>
                        <td>
                            <input type="radio" name="selected_item" value="Ada"> Ada
                            <span></span>
                            <input type="radio" name="selected_item" value="Tidak Ada" style="margin-left: 1em"> Tidak
                            Ada
                        </td>
                        <td><span class="badge bg-label-info me-1">Dokumen</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
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
@endsection
