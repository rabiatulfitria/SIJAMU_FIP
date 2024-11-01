@extends('User.admin.Pelaksanaan.sidebar_fakultas')
@section('tabel-unggah-dokumen')
<a href="/tambah-dokumen-pelaksanaan-fakultas" class="btn btn-primary mb-3">Tambah Dokumen</a>

<div id="DatatablesRenstraProgramStudinya">
    <!-- Tabel CPL di sini -->
    <table class="table table-bordered custom-table-sm" >
                <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Dokumen Formulir Kepuasan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($renstraFakultas as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->namafile }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan-fakultas/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaanFakultas', $document->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
<div id="DatatablesLaporanKinerjaFakultas">
    <!-- Tabel CPL di sini -->
    <table class="table table-bordered custom-table-sm" >
                <thead>
        <tr>
            <th>No</th>
            <th>Program Studi</th>
            <th>Dokumen Formulir Kepuasan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporanKinerjaFakultas as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->namafile }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan-fakultas/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaanFakultas', $document->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection
