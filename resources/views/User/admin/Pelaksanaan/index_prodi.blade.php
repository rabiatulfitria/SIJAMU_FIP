@extends('User.admin.Pelaksanaan.sidebar_prodi')
@section('tabel-unggah-dokumen')
<a href="/tambah-dokumen-pelaksanaan" class="btn btn-primary mb-3">Tambah Dokumen</a>
    <!-- Tabel yang akan ditampilkan -->
    <div id="DatatablesRenstraProgramStudinya">
        <!-- Tabel Kinerja Program Studi di sini -->
        <table class="table table-bordered custom-table-sm" >
                    <thead>
            <tr>
                <th>No</th>
                <th>Program Studi</th>
                <th>Dokumen Renstra</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($renstraProgramStudi as $index => $document)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $document->nama_prodi }}</td>
                    <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                    <td>
                        <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id_plks_prodi) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('deletePelaksanaan', $document->id_plks_prodi) }}" method="POST" style="display: inline;">
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

    <div id="DatatablesKinerjaProgramStudinya">
        <!-- Tabel Kinerja Program Studi di sini -->
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
            @foreach($laporanKinerjaProgramStudi as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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

    <div id="DatatablesKurikulum">
        <!-- Tabel Dokumen Kurikulum di sini -->
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
            @foreach($dokumenKurikulum as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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

    <div id="DatatablesRPS">
        <!-- Tabel RPS di sini -->
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
            @foreach($rps as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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

    <div id="DatatablesMonitoring">
        <!-- Tabel Monitoring di sini -->
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
            @foreach($monitoringMbkm as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
    <div id="DatatablesCPL">
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
            @foreach($cpl as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
    <div id="DatatablesPanduanRPS">
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
            @foreach($panduanRps as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
    <div id="DatatablesPanduanMutuSoal">
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
            @foreach($panduanMutuSoal as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
    <div id="DatatablesPanduanKisi">
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
            @foreach($panduanKisiKisi as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
    <div id="DatatablesFormulirKepuasan">
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
            @foreach($formulirKepuasan as $index => $document)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $document->nama_prodi }}</td>
                <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                <td>
                    <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
    <div id="DatatablesMonitoringLayanan">
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
            @foreach($monitoringKemahasiswaan as $index => $document)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $document->nama_prodi }}</td>
                    <td><a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->namafile }}</a></td>
                    <td>
                        <a href="{{ url('/edit-dokumen-pelaksanaan/' . $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('deletePelaksanaan', $document->id) }}" method="POST" style="display: inline;">
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
