@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span><b> Success - </b> {{ session('status') }}</span>
                </div>
            @endif
        </div>
    </div>
@endsection
