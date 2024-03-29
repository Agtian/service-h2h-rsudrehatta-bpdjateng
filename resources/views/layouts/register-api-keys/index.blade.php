@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @livewire('register-api-keys.table-data-api-key')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addApiKey').modal('hide');
            $('#editApiKey').modal('hide');
        });
    </script>
@endpush
