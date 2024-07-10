@extends('User.admin.Pelaksanaan.sidebar')
@section('sidebar-pelaksanaan')
<div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
                <img src="{{ asset('sneat/assets/img/favicon/LOGO FIP.png') }}" width="55" height="55">
                <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize fs-4">SIJAMU
                    FIP</span>
            </a>

            <a href="javascript:void(0);"
                class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Standar Proses Pembelajaran -->
            <li class="menu-item {{ \Route::is('dokumenkurikulum') ? 'active' : '' }}">
                <a href="{{ route('BerandaSIJAMUFIP') }}" class="menu-link">
                    <div data-i18n="Home">Dokumen Kurikulum</div>
                </a>
            </li>

            <li class="menu-item {{ \Route::is('rps') ? 'active' : '' }}">
                <a href="{{ route('TimJAMU') }}" class="menu-link">
                    <div data-i18n="TimJAMU">Rencana Pembelajaran Semester (RPS)</div>
                </a>

            {{-- <li class="menu-item {{ \Route::is('penetapan*') ? 'active' : '' }}">
                <a href="{{ route('penetapan') }}" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-book-bookmark'></i>
                    <div data-i18n="Penetapan">Dokumen Monitoring & Evaluasi Program Merdeka Belajar</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ \Route::is('penetapan') ? 'active' : '' }}">
                        <a href="{{ route('penetapan') }}" class="menu-link">
                            <div data-i18n="Perangkat">Perangkat SPMI</div>
                        </a>
                    </li>
                    <li class="menu-item {{ \Route::is('penetapan.standar') ? 'active' : '' }}">
                        <a href="{{ route('penetapan.standar') }}" class="menu-link">
                            <div data-i18n="Standar">Standar Yang Ditetapkan Institusi</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ \Route::is('pelaksanaan.prodi') ? 'active' : '' }}">
                <a href="{{ route('pelaksanaan.prodi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-book-open"></i>
                    <div data-i18n="Pelaksanaan">Pelaksanaan</div>
                </a>
            </li>
            <li class="menu-item {{ \Route::is('evaluasi') ? 'active' : '' }}">
                <a href="{{ route('evaluasi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-task"></i>
                    <div data-i18n="Evaluasi">Evaluasi</div>
                </a>
            </li>
            <li class="menu-item {{ \Route::is('pengendalian') ? 'active' : '' }}">
                <a href="{{ route('pengendalian') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-sync bx-sm"></i>
                    <div data-i18n="Pengendalian">Pengendalian</div>
                </a>
            </li>
            <li class="menu-item {{ \Route::is('peningkatan') ? 'active' : '' }}">
                <a href="{{ route('peningkatan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bar-chart-alt bx-sm"></i>
                    <div data-i18n="Pengendalian">Peningkatan</div> --}}
                {{-- </a>
            </li> --}}
        </ul>
    </aside>
</div>
<div>
    @yield('content-dokumen')
</div>
    
@endsection