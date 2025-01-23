@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-items d-flex align-item-center">Edit Peningkatan Standar Yang Ditetapkan Institusi</div>
        </div>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateDokumenPeningkatan', $oldData->id_peningkatan) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="formFileMultiple">Pilih Dokumen</label>
                                <input type="file" class="form-control" value="" id="formFileMultiple" multiple
                                    name="file_peningkatan[]" />
                                <p class="form-text" style="color: #7ebcfe">Maksimum 5120 KB (5 MB)</p>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">{{ isset($peningkatan) }}Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
