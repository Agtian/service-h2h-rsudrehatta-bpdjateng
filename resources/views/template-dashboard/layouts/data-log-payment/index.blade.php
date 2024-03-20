@extends('template-dashboard.main')

@section('content')
<div class="row mt-6">
    <div class="col-12">
        @livewire('data-log-payment.table-data-log-payment')
    </div>
</div>
@endsection
