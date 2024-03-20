@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show mx-4" role="alert">
        <span class="alert-text"><strong>Perhatian!</strong> {{ session('warning') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
