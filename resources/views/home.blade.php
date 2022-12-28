@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                @if (isset($banner))
                    @if($banner=="first")
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5>@lang('public.welcome')</h5>
                        <img src="{{ asset('img/welcome.png') }}" style="width: 50%;height:50%">
                    </div>
                    @else
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5>@lang('public.thank')</h5>
                        <img src="{{ asset('img/thank.png') }}" style="width: 50%;height:50%">
                    </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
@endsection