@extends('template-dashboard.main')

@section('content')
<div class="row {{ count($resultAPIKEY) == 0 ? 'mt-6' : '' }}">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data API KEY</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-hover align-items-center mb-0">
                        <thead>
                            <tr class="bg-dark">
                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Project Name & API KEY</th>
                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultAPIKEY as $item)
                                <tr>
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
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->project_name }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $item->key }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($item->status_api_key == 1)
                                            <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center align-middle text-center text-sm">Data tidak tersedia !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $resultAPIKEY->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
