@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Table Log Payments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50">NO</th>
                                    <th>NO PEMBAYARAN</th>
                                    <th>NO BUKTI BAYAR</th>
                                    <th>NO MEDIS</th>
                                    <th>NAMA PASIEN</th>
                                    <th>BIAYA</th>
                                    <th class="text-center">STATUS PAYMENT</th>
                                    <th class="text-center">STATUS REVERSAL</th>
                                    <th class="text-center">DATE SYSTEM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($resultLogPayments as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration + $resultLogPayments->firstItem() - 1 }}</td>
                                        <td>{{ $item->nopembayaran }}</td>
                                        <td>{{ $item->nobuktibayar }}</td>
                                        <td>{{ $item->no_rekam_medik }}</td>
                                        <td>{{ $item->nama_pasien }}</td>
                                        <td>{{ $item->totalbiayapelayanan }}</td>
                                        <td class="text-center">
                                            @if ($item->status_payment === 0)
                                                <button class="btn btn-sm btn-primary">Belum bayar</button>
                                            @elseif ($item->status_payment === 1)
                                                <button class="btn btn-sm btn-success">Lunas</button>
                                            @else
                                                <button class="btn btn-sm btn-danger">Batal bayar</button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status_reversal === 0)
                                                <button class="btn btn-sm btn-danger">Connection time out</button>
                                            @elseif ($item->status_reversal === 1)
                                                <button class="btn btn-sm btn-success">Connected</button>
                                            @else

                                            @endif
                                        </td>
                                        <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Data tidak tersedia !</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $resultLogPayments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
