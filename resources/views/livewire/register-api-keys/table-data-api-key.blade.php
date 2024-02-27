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

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="addApiKey" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background: #1e1e2f">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Form Tambah API Keys</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" wire:model.defer="company_name" class="form-control bg-darker @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" placeholder="The name of the person in charge">
                                            @error('company_name')
                                                <span class="invalid-feedback" style="margin-top: -20px" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Project</label>
                                            <input type="text" wire:model.defer="project_name" class="form-control bg-darker @error('project_name') is-invalid @enderror" value="{{ old('project_name') }}" placeholder="The name project">
                                            @error('project_name')
                                                <span class="invalid-feedback" style="margin-top: -20px" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <select wire:model.defer="status_api_key" class="form-control bg-darker @error('status_api_key') is-invalid @enderror">
                                                <option value="">-- Select status --</option>
                                                <option value="aktif">Aktif</option>
                                                <option value="tidak_aktif">Tidak aktif</option>
                                            </select>
                                            @error('status_api_key')
                                                <span class="invalid-feedback" style="margin-top: -20px" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" wire:click="store()" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

                                </td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger">Ubah</button>
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
    </div>

    @push('scripts')
        <script type="text/javascript">
            window.livewire.on('userStore', () => {
                $('#exampleModal').modal('hide');
            });
        </script>
    @endpush
</div>
