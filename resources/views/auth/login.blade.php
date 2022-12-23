@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">@lang('public.login')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="m-3">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label">@lang('public.email')</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autofocus>
                                @error('email')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label">@lang('public.password')</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center gap-3">
                            <button class="btn" type="submit" style="background-color: #D09CFA;">@lang('public.login')</button>
                            <button type="reset" class="btn btn-secondary" >@lang('public.cancel')</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection