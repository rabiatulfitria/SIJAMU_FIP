@extends('User.admin.Pelaksanaan.sidebar_fakultas')
@section('tabel-unggah-dokumen')
<a href="/tambah-dokumen-pelaksanaan-fakultas" class="btn btn-primary mb-3">Tambah Dokumen</a>

<div id="DatatablesRenstraProgramStudinya">
    <!-- Tabel Renstra Fakultas di sini -->
    <table class="table table-bordered custom-table-sm" >
                <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Dokumen Renstra Fakultas</th>
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
                    <a href="{{ url('/edit-dokumen-pelaksanaan-fakultas/' . $document->id_plks_fklts) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaanFakultas', $document->id_plks_fklts) }}" method="POST" style="display: inline;">
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
    <!-- Tabel LaKin Fakultas di sini -->
    <table class="table table-bordered custom-table-sm" >
                <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Dokumen Laporan Kinerja Fakultas</th>
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
                    <a href="{{ url('/edit-dokumen-pelaksanaan-fakultas/' . $document->id_plks_fklts) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaanFakultas', $document->id_plks_fklts) }}" method="POST" style="display: inline;">
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
