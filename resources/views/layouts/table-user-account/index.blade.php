@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Table User Account</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center" width="50">NO</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($resultUserAccount as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration + $resultUserAccount->firstItem() - 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data tidak tersedia !</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $resultUserAccount->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
