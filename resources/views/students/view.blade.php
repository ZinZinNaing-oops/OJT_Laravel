@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container row justify-content-center">
        @if(session('info'))
        <div class="alert alert-success d-flex flex-row align-items-center justify-content-between" role="alert" style="height: 45px;width:40%">
            <div>
                <i class="bi bi-check-circle-fill"></i>
                <strong> @lang('public.successful') ! </strong>
                {{ session('info') }}
            </div>
            <i class="bi bi-x-lg" style="cursor:pointer" data-bs-dismiss="alert"></i>
        </div>
        @endif
        <p class="d-flex justify-content-end">@lang('public.date'): <input type="text" id="date" name="date"></p>
        <table class="table table-bordered user_datatable" id="user_datatable">
            <thead>
                <tr class="table-secondary">
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.num')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.name')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.roll_no')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.age')</th>
                    <th scope="col" class="text-center" style="background-color: #D09CFA;">@lang('public.created_at')</th>
                </tr>
            </thead>
            <tbody class="text-center"></tbody>
        </table>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $("#date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#user_datatable').DataTable({
            //data table attribute show or hide
            processing: true,
            lengthChange: false,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ url('/students/view_student_list/') }}",
                type: 'GET',
                data: function(d) {
                    d.date = $('#date').val();
                }
            },
            columns: [
                //add No column 
                {
                    data: 'SrNo',
                    render: function(data, type, row, meta) {
                        //value in No column(auto increment)
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    searchable: false,
                    sortable: false,
                },

                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'roll_no',
                    name: 'roll_no'
                },
                {
                    data: 'age',
                    name: 'age'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
            ],
            language: {
                "search": "{{ __('public.search') }}",
                "info": "{{ __('public.info') }}",
                "infoEmpty": "{{ __('public.infoEmpty') }}",
                "lengthMenu": "{{ __('public.lengthMenu') }}",
                "infoFiltered": "{{ __('public.infoFiltered') }}",
                "emptyTable": "{{ __('public.emptyTable') }}",
                "zeroRecords": "{{ __('public.zeroRecords') }}",
                "paginate": {
                    "first": "{{ __('public.first') }}",
                    "last": "{{ __('public.last') }}",
                    "next": "{{ __('public.next') }}",
                    "previous": "{{ __('public.previous') }}"
                },
            }

        });
        $('#date').change(function() {
            $('#user_datatable').DataTable().draw(true);
        })
    })
</script>
@endsection