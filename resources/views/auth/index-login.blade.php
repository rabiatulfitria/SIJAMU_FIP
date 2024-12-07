@extends('layout.index-login-auth')

@section('index-content')
    @include('_partials.alert')
    <span class="app-brand-logo demo">
        <img src="{{ asset('sneat/assets/img/favicon/LogoFIP.png') }}" alt="">
    </span>
    <h1 class="fst-bold lh-1 mb-4">SIJAMU FIP</h1>
    <p class="mb-5">Sistem Informasi Sistem Penjaminan Mutu Internal Fakultas Ilmu Pendidikan Universitas Trunojoyo Madura
    </p>
    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                autofocus />
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="basic-default-password32">Password</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="basic-default-password32" class="form-control" name="password" placeholder="Masukkan Password"
                    aria-describedby="basic-default-password" />
                <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide" style="z-index: 15"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">LOGIN</button>
        </div>
    </form>
@endsection
