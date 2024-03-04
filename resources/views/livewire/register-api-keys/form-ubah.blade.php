<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editApiKey" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #1e1e2f">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Form Ubah API Keys</h5>
                <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
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
                                <label>X API-KEY</label>
                                <input type="text" wire:model="key" class="form-control bg-darker text-white" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select wire:model="status_api_key" class="form-control bg-darker @error('status_api_key') is-invalid @enderror">
                                    <option value="">-- Select status --</option>
                                    <option value="1" {{ $status_api_key == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ $status_api_key == 0 ? 'selected' : '' }}>Tidak aktif</option>
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
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update({{ $id }})" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
