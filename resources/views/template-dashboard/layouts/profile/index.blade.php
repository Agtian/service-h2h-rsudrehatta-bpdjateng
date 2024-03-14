@extends('template-dashboard.main')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

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
                    @if ($formModalActivate == false)
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#modalActivation">
                            Activate Account Now
                        </button>
                    @endif
                </div>
                <div class="card-body pt-0">
                    <div class="text-center mt-4">
                        <div>
                            <i class="ni education_hat mr-2"></i>Aktivasi sekarang dan anda akan mendapatkan kode aktivasi melalui SMS
                            @if ($formInputKodeActivate == true)
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" placeholder="Masukan kode activation" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary mb-0" type="button" id="button-addon2">Send activation</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalActivation" tabindex="-1" role="dialog" aria-labelledby="modalActivation" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalActivation">Activate Account Now</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url(request()->segment(1).'/activate-account') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="py-3 text-center">
                                    <i class="ni ni-bell-55 ni-3x"></i>
                                    <h4 class="text-gradient text-danger mt-4">You should read this!</h4>
                                    <p>Are you sure you want to activate your account?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ok, Got it</button>
                                <button type="button" class="btn btn-dark text-white ml-auto" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>

    window.addEventListener('swal:modal', event => {
        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
        });
    });

    window.addEventListener('swal:confirm', event => {
        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.livewire.emit('remove');
          }
        });
    });
     </script>
@endpush
