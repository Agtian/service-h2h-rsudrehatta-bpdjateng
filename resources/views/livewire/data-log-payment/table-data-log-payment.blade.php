<div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Data Log Payment</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">User</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">No Pembayaran</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">No Bukti Bayar</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Total Biaya</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Pasien</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Tanggal Daftar</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Tanggal Payment</th>
                            <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Status Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resultDataLogPayment as $item)
                            <tr class="bg-gray-200">
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <i class="avatar avatar-sm me-3 ni ni-single-02 text-success text-sm opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ optional($item->getApiKey)->company_name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ optional($item->getApiKey)->project_name }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->status_key == 0 ? 'Development' : 'Production' }}<p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->nopembayaran }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->nobuktibayar }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item->totalbiayapelayanan, 2, ",", ".") }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $item->nama_pasien }} ({{ $item->usia }} thn)</h6>
                                        <p class="text-xs text-secondary mb-0">{{ $item->no_rekam_medik }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $item->alamat_pasien }}</p>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ date('h:i:s', strtotime($item->tgl_pendaftaran)) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ date('h:i:s d/m/Y', strtotime($item->created_at)) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    @if ($item->status_payment == 1)
                                        <button class="btn btn-sm bg-gradient-success text-dark">Lunas</button>
                                    @elseif ($item->status_payment == 2)
                                        <button class="btn btn-sm bg-gradient-danger">Batal Bayar</button>
                                    @endif
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
                {{ $resultDataLogPayment->links() }}
            </div>
        </div>
    </div>
</div>
