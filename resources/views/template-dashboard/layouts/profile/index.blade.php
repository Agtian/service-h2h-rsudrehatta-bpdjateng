@extends('template-dashboard.main')

@section('content')
<div class="card shadow-lg mx-4">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('asset/img/user-286.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $detailUser->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $detailUser->company }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <a class="btn btn-outline-danger mb-0 px-0 py-1 d-flex align-items-center justify-content-center">
                <i class="ni ni-notification-70"></i>
                    <span class="ms-2">Account tidak aktif</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto">Settings</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="company" class="form-control-label">Company</label>
                            <input class="form-control" id="company" type="text" value="{{ $detailUser->company }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input class="form-control" id="name" type="text" value="{{ $detailUser->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" id="email" type="text" value="{{ $detailUser->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="no_hp" class="form-control-label">No Handphone</label>
                            <input class="form-control" id="no_hp" type="text" value="{{ $detailUser->no_hp }}" readonly>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">API Key Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="key" class="form-control-label">API KEY</label>
                            <input class="form-control" id="key" type="text" value="{{ $detailApiKey->key }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="key" class="form-control-label">Status</label>
                            <input class="form-control" id="key" type="text" value="{{ $detailApiKey->status_api_key == 0 ? 'Tidak aktif' : 'Aktif' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="key" class="form-control-label">Project Name</label>
                            <input class="form-control" id="key" type="text" value="{{ $detailApiKey->project_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="key" class="form-control-label">Kategory Key</label>
                            <input class="form-control" id="key" type="text" value="{{ $detailApiKey->status_key == 0 ? 'Development' : 'Production' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <img src="{{ asset('asset/img/carousel-3.jpg') }}" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                    <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                        <a href="javascript:;">
                            <img src="{{ asset('asset/img/user-286.png')}}" class="rounded-circle img-fluid border border-2 border-white">
                        </a>
                    </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <a href="" class="btn btn-md btn-danger float-right mb-0 d-none d-lg-block">Activate Account Now</a>
                </div>
                <div class="card-body pt-0">
                    <div class="text-center mt-4">
                        <div>
                            <i class="ni education_hat mr-2"></i>Anda akan mendapatkan kode aktivasi melalui SMS
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
