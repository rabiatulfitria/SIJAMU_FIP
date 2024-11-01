@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h5 class="mb-0 text-success">Berhasil</h5>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="mb-0 text-danger">Gagal</h5>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('any'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <h5 class="mb-0 text-danger">Terjadi Kesalahan !</h5>
        {{ session('any') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
