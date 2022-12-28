@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"> @lang('public.update_student')</div>
                <div class="card-body">
                    <form class="m-3" method="POST" action="{{route('update')}}">
                        @csrf
                        @method('put')
                        @if(isset($students))
                        <div>
                            <div class="form-group row mb-4">
                                <label class="col-sm-3 col-form-label">@lang('public.roll_no')</label>
                                <div class="col-sm-9">
                                    <select class="form-select  form-control @error('roll_no') is-invalid @enderror" value="{{old('roll_no')}}" name="id" id="id">
                                        <option value="" selected>@lang('public.choose_roll_no')</option>
                                        @foreach($students as $student)
                                        <option value={{ $student->id }} {{ $student->roll_no ==old('roll_no') ? 'selected': '' }}>{{$student->roll_no}}</option>
                                        <div type="hidden" name="id" value="{{$student->id}}" id="{{$student->id}}"></div>
                                        @endforeach
                                    </select>
                                    @error('roll_no')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                        </div>
                        @else
                        <div>
                        <input type="hidden"  name="id" value="{{$student->id}}" id="id">
                            <div class="form-group row mb-4">
                                <label class="col-sm-3 col-form-label">@lang('public.roll_no')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('roll_no') is-invalid @enderror" name="roll_no" value="{{$student->roll_no}}" id="roll_no" disabled>
                                    @error('roll_no')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">@lang('public.name')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$student->name}}" id="name">
                                    @error('name')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">@lang('public.age')</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{$student->age}}" id="age">
                                    @error('age')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex flex-row justify-content-center gap-3">
                            <button class="btn" type="submit" style="background-color: #D09CFA;">@lang('public.update')</button>
                            <button type="reset" class="btn btn-secondary">@lang('public.cancel')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/GetStudentById.js') }}" defer></script>
@endsection