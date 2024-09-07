@extends('User.admin.Pelaksanaan.sidebar_prodi')
@section('tabel-unggah-dokumen')
    <table class="table table-bordered custom-table-sm" id="Datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Program Studi</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($programStudis as $programStudi) --}}
            {{-- <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $programStudi->name }} - {{ $programStudi->level }}</td>
                        <td>{{ $programStudi->akreditasi_2020 }}</td>
                        <td>{{ $programStudi->akreditasi_2021 }}</td>
                        <td>{{ $programStudi->akreditasi_2022 }}</td>
                    </tr> --}}
            <tr>
                <td>1</td>
                <td>aaaaaaaaa</td>
                <td>jsdbhdbnd</td>
                <td>jsdbhdbnd</td>
            </tr>
            <tr>
                <td>1</td>
                <td>aaaaaaaaa</td>
                <td>jsdbhdbnd</td>
                <td>jsdbhdbnd</td>
            </tr>
            <tr>
                <td>1</td>
                <td>bbbbbbbbb</td>
                <td>jsdbhdbnd</td>
                <td>jsdbhdbnd</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ccccccccc</td>
                <td>jsdbhdbnd</td>
                <td>jsdbhdbnd</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ddddddddd</td>
                <td>jsdbhdbnd</td>
                <td>jsdbhdbnd</td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
@endsection
