@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container row justify-content-center">
        <div class="alert alert-success d-flex flex-row align-items-center justify-content-between d-none" role="alert" style="height: 45px;width:40%;">
            <div>
                <i class="bi bi-check-circle-fill"></i>
                <strong> @lang('public.successful') ! </strong>
                @lang('public.successful_deleted')
            </div>
            <i class="bi bi-x-lg" style="cursor:pointer" id="dismiss"></i>
        </div>
        <table class="table table-bordered user_datatable text-center">
            <thead class="text-center">
                <tr class="table-secondary">
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.num')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.name')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.roll_no')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.age')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.created_at')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.action')</th>
                </tr>
            </thead>
            <tbody class="text-center"></tbody>

        </table>
        <!-- Modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('public.delete_student')</h5>
                        <i class="bi bi-x-lg" style="cursor:pointer" data-bs-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <p>@lang('public.delete_confirm')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" name="yes" id="yes">@lang('public.yes')</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('public.no')</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // text for language
    var search = "{{ __('public.search') }}";
    var deleting = "{{ __('public.deleting') }}";
    var yes = "{{ __('public.yes') }}";
    var info = "{{ __('public.info') }}";
    var infoEmpty = "{{ __('public.infoEmpty') }}";
    var lengthMenu = "{{ __('public.lengthMenu') }}";
    var infoFiltered = "{{ __('public.infoFiltered') }}";
    var emptyTable = "{{ __('public.emptyTable') }}";
    var zeroRecords = "{{ __('public.zeroRecords') }}";
    var first = "{{ __('public.first') }}";
    var last = "{{ __('public.last') }}";
    var next = "{{ __('public.next') }}";
    var previous = "{{ __('public.previous') }}";
</script>
<script src="{{ asset('js/DeleteStudent.js') }}" defer></script>
@endsection