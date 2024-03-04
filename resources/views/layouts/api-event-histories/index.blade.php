@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Table API Event Histories</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center" width="50">NO</th>
                                    <th>COMPANY</th>
                                    <th>API ADDRESS</th>
                                    <th>URL</th>
                                    <th>USER AGENT</th>
                                    <th>CREATED AT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($resultApiEventHistories as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration + $resultApiEventHistories->firstItem() - 1 }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->api_address }}</td>
                                        <td>{{ $item->url }}</td>
                                        <td>{{ $item->user_agent }}</td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak tersedia !</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $resultApiEventHistories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var myModal = document.getElementById('exampleModal')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script>
@endsection
