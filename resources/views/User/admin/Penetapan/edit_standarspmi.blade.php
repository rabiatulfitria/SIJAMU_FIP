@extends('layout.sidebar')

@section('navbar')
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-items d-flex align-item-center">Dokumen Standar SPMI Universitas Trunojoyo Madura</div>
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
                        <form method="POST" action="/Penetapan/{{$oldData->id_penetapan}}/updateDokumenPerangkat">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nama Dokumen</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        name="Nama Dokumen" value="" placeholder="Nama Dokumen" aria-label=""
                                        aria-describedby="basic-icon-default-fullname2" />
                                </div>
                            </div>
                            <div class="form-check mt-3">
                                {{-- {{ dd($oldData) }} --}}

                                <input name="default-radio-1" class="form-check-input" type="radio" value="{{$oldData->status_dokumen}}"
                                    id="defaultRadio1" />
                                <label class="form-check-label" for="defaultRadio1"> Ada </label>
                            </div>
                            <div class="form-check">
                                <input name="default-radio-1" class="form-check-input" type="radio" value="{{$oldData->status_dokumen}}"
                                    id="defaultRadio2" checked />
                                <label class="form-check-label" for="defaultRadio2"> Tidak Ada </label>
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Pilih File</label>
                                <input class="form-control" type="file" name="files[]" value="{{$oldData->filePaths}}" id="formFileMultiple" multiple />
                              </div>
                            <button type="submit" class="btn btn-primary">{{ isset($perangkat) }}Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
