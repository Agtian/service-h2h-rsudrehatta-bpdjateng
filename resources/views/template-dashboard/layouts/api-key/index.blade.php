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
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            <img class="w-10 me-3 mb-0" src="{{ asset('asset/img/logos/mastercard.png') }}" alt="logo">
                            <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            <img class="w-10 me-3 mb-0" src="{{ asset('asset/img/logos/visa.png')}}" alt="logo">
                            <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248</h6>
                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection