@extends('template-dashboard.main')

@section('content')
<div class="row {{ count($resultUsers) == 0 ? 'mt-6' : '' }}">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Log Services</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-hover align-items-center mb-0">
                        <thead>
                            <tr class="bg-dark">
                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Company</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Level</th>
                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultUsers as $item)
                                <tr class="{{ $item->company == '' ? 'bg-gray-200' : '' }}">
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->company }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if ($item->level_user == 1)
                                                    <i class="avatar avatar-sm me-3 ni ni-single-02 text-info text-sm opacity-10"></i>
                                                @elseif ($item->level_user == 2)
                                                    <i class="avatar avatar-sm me-3 ni ni-single-02 text-primary text-sm opacity-10"></i>
                                                @else
                                                    <i class="avatar avatar-sm me-3 ni ni-single-02 text-danger text-sm opacity-10"></i>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{  $item->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{  $item->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($item->level_user == 1)
                                            <span class="badge badge-sm bg-gradient-info">User</span>
                                        @elseif ($item->level_user == 2)
                                            <span class="badge badge-sm bg-gradient-primary">Administrator</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-danger">Not Registered</span>
                                        @endif
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
                    {{ $resultUsers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
