@extends('template-dashboard.main')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h5 class="mb-0 font-weight-bold">Base URL Web Service Development</h5>
            </div>
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

    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h5 class="mb-0 font-weight-bold">Inquiry Data Tagihan</h5>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    {{-- <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-200 border-radius-lg">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">Oliver Liam</h6>
                            <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                            <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                            <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                        </div>
                    </li> --}}

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
@endsection
