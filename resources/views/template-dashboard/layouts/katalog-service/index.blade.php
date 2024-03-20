@extends('template-dashboard.main')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <button class="btn bg-gradient-primary" type="button" data-bs-toggle="collapse" data-bs-target="#one" aria-expanded="false">
                    <h5 class="mb-0 font-weight-bold text-white">Base URL Web Service Development</h5>
                </button>
            </div>
            <div class="collapse" id="one">
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <div class="row">
                            <div class="col-md-6">
                                <p>URL</p>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                    <pre>
    <code>https://h2h.rsudrehatta.id</code>
                                    </pre>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <p>Authorization</p>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <span class="mb-2 text-xs">Key : <span class="text-dark font-weight-bold ms-sm-2">api_key</span></span>
                                        <span class="mb-2 text-xs">Value : <span class="text-dark ms-sm-2 font-weight-bold">apikey123</span></span>
                                        <span class="text-xs">Add To : <span class="text-dark ms-sm-2 font-weight-bold">Header</span></span>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <button class="btn bg-gradient-primary" type="button" data-bs-toggle="collapse" data-bs-target="#two" aria-expanded="false">
                    <h5 class="mb-0 font-weight-bold text-white">Inquiry Data Tagihan</h5>
                </button>
            </div>
            <div class="collapse" id="two">
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <p>Method : <b>GET</b></p>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Request</p>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                    <pre>
    <code>{Base URL}/api/patient-bill?nomormedis=123456</code>
                                    </pre>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <p>Response</p>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                    <pre>
        <code>{{ $responseGetDataTagihan }}</code>
                                    </pre>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <button class="btn bg-gradient-primary" type="button" data-bs-toggle="collapse" data-bs-target="#three" aria-expanded="false">
                    <h5 class="mb-0 font-weight-bold text-white">Flag Payment</h5>
                </button>
            </div>
            <div class="collapse" id="three">
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <p>Method : <b>POST</b></p>
                        <p>URL : <b>{Base url} /api/response-payment</b></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p>Request</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
        nopembayaran :
        nokuitansi :
        nobuktibayar :
        totalbiayapelayanan :
        nama_pasien :
        no_rekam_medik :
        tanggal_lahir :
        tgl_pendaftaran :
        status_payment :
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Status Payment</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
        0 : belum_bayar
        1 : lunas
        2 : batal_bayar
                                        </pre>
                                    </li>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p>Response Success</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseFlag }}</code>
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Response payment status in full</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseFlagStatusFull }}</code>
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Response parameter not found</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseFlagNoPembayaranFail }}</code>
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Response parameter required</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseFlagRequired }}</code>
                                        </pre>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <button class="btn bg-gradient-primary" type="button" data-bs-toggle="collapse" data-bs-target="#four" aria-expanded="false">
                    <h5 class="mb-0 font-weight-bold text-white">Flag Reversal</h5>
                </button>
            </div>
            <div class="collapse" id="four">
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <p>Method : <b>POST</b></p>
                        <p>URL : <b>{Base url} /api/response-reversal</b></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p>Request</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
        nopembayaran :
        nokuitansi :
        nobuktibayar :
        totalbiayapelayanan :
        nama_pasien :
        no_rekam_medik :
        tanggal_lahir :
        tgl_pendaftaran :
        status_reversal :
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Status reversal</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
        0 : connection_timeout
        1 : connected
                                        </pre>
                                    </li>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <p>Response Success</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseReversal }}</code>
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Response parameter not found</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseReversalNotFound }}</code>
                                        </pre>
                                    </li>
                                </div>
                                <div class="col-md-12">
                                    <p>Response parameter required</p>
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                                        <pre>
            <code>{{ $responseReversalRequired }}</code>
                                        </pre>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
