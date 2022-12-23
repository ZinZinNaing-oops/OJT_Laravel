<style>
            label.error {
                color: red;
                font-size:13px
        }
</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"> @lang('public.add_student')</div>
                <div class="card-body">
                    <form class="m-3" method="post" id="form">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label">@lang('public.name')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" id="name">
                                @error('name')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label">@lang('public.age')</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{old('age')}}" id="age">
                                @error('age')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">@lang('public.roll_no')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('roll_no') is-invalid @enderror" name="roll_no"  id="roll_no"
                                    value="{{old('roll_no')}}" placeholder="eg.2IS-1">
                                @error('roll_no')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center gap-3">
                            <button class="btn" type="submit" style="background-color: #D09CFA;">@lang('public.register')</button>
                            <button type="reset" class="btn btn-secondary" >@lang('public.cancel')</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="{{ asset('js/ErrorMessageOnFocus.js') }}" defer></script> -->
<script src="{{ asset('js/student_form_validation.js') }}" defer></script>
@endsection