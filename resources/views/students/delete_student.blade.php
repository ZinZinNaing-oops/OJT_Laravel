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
                    <th scope="col" class="text-center">@lang('public.num')</th>
                    <th scope="col" class="text-center">@lang('public.name')</th>
                    <th scope="col" class="text-center">@lang('public.age')</th>
                    <th scope="col" class="text-center">@lang('public.roll_no')</th>
                    <th scope="col" class="text-center">@lang('public.created_at')</th>
                    <th scope="col" class="text-center">@lang('public.delete')</th>
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
    $(document).ready(function() {
        var id;
        $('#dismiss').click(function() {
            $('.alert').addClass('d-none').removeClass('d-block');
        })
        $(document).on('click', '.delete', function() {
            id = $(this).attr('id');
            $("#deleteConfirmModal").modal('show');
        });
        $('#yes').click(function() {
            var deleting = "{{ __('public.deleting') }}";
            var yes = "{{ __('public.yes') }}";
            $.ajax({
                type: 'GET',
                url: "/students/delete_student/",
                data: {
                    'id': id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#yes').text(deleting);
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#deleteConfirmModal').modal('hide');
                        $('#yes').text(yes);
                        $('.alert').addClass('d-block').removeClass('d-none');
                        $('.user_datatable').DataTable().ajax.reload();

                    }, 2000);
                }

            })
        })
        $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/students/delete',
            columns: [{
                    data: 'SrNo',
                    render: function(data, type, row, meta) {
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
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
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
    })
</script>

@endsection