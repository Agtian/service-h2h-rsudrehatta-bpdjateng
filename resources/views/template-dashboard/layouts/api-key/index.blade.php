@extends('template-dashboard.main')

@section('content')
<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
        <div class="card mt-4">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">API KEY Method</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            <img class="w-3 me-3 mb-0" src="{{ asset('asset/img/logos/key.png')}}" alt="logo">
                            <h6 class="mb-0">{{ optional($detailApiKey)->key }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-2">User Information</h6>
                </div>
                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-md-3">
                        <label for="name" class="col-form-label">User</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="name" class="form-control" readonly value="{{ optional($detailApiKey->getUser)->name }}">
                    </div>
                </div>
                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-md-3">
                        <label for="company_name" class="col-form-label">Company</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="company_name" class="form-control" readonly value="{{ $detailApiKey->company_name }}">
                    </div>
                </div>
                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-md-3">
                        <label for="project_name" class="col-form-label">Project Name</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="project_name" class="form-control" readonly value="{{ $detailApiKey->project_name }}">
                    </div>
                </div>
                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-md-3">
                        <label for="key" class="col-form-label">API Key</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="key" class="form-control" readonly value="{{ optional($detailApiKey)->key }}">
                    </div>
                </div>
                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-md-3">
                        <label for="status" class="col-form-label">Status API Key</label>
                    </div>
                    <div class="col-md-9">
                        @if ($detailApiKey->status_api_key == 1)
                            <button id="status" class="btn btn-sm btn-success">Aktif</button>
                        @else
                            <button id="status" class="btn btn-sm btn-danger">Tidak Aktif</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
