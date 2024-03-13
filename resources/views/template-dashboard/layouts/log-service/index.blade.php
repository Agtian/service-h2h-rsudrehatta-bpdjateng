@extends('template-dashboard.main')

@section('content')
<div class="row {{ count($resultLogServices) == 0 ? 'mt-6' : '' }}">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Log Services</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-hover align-items-center mb-0">
                        <thead>
                            <tr class="bg-dark">
                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">API Address</th>
                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">User Agent</th>
                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultLogServices as $item)
                                <tr class="{{ optional($item->getUser)->name == '' ? 'bg-gray-200' : '' }}">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <i class="avatar avatar-sm me-3 ni ni-single-02 text-success text-sm opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ optional($item->getUser)->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ optional($item->getUser)->email }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $item->company_name }}<p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->api_address }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->user_agent }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ date('h:i:s d/m/Y', strtotime($item->created_at)) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center align-middle text-center text-sm">Data tidak tersedia !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $resultLogServices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
