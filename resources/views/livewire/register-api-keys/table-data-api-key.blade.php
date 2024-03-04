<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span><b> Success - </b> {{ session('success') }}</span>
        </div>
    @endif

    <div class="card ">
        <div class="card-header">
            <h4 class="card-title"> Table API Keys</h4>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addApiKey">
                Tambah API Keys
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tablesorter" id="">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-center" width="50">NO</th>
                            <th>NAME</th>
                            <th>PROJECT</th>
                            <th>KEY</th>
                            <th>STATUS</th>
                            <th>CREATED AT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resultAPIKeys as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + $resultAPIKeys->firstItem() - 1 }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->project_name }}</td>
                                <td>{{ $item->key }}</td>
                                <td>
                                    @if ($item->status_api_key == 0)
                                        <button class="btn btn-sm btn-danger btn-block">TIDAK AKTIF</button>
                                    @else
                                        <button class="btn btn-sm btn-success btn-block">AKTIF</button>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" wire:click.prevent="edit({{ $item->id }})" data-target="#editApiKey">Ubah</button>
                                </td>
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
                {{ $resultAPIKeys->links() }}
            </div>
        </div>

        @include('livewire.register-api-keys.form-tambah')
        @include('livewire.register-api-keys.form-ubah')
    </div>

    @push('scripts')
        <script type="text/javascript">
            window.livewire.on('userStore', () => {
                $('#exampleModal').modal('hide');
            });

            window.livewire.on('closeModal', () => {
                $('#addApiKey').modal('hide');
            });
        </script>
    @endpush
</div>
