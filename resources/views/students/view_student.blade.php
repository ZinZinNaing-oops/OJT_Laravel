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
        <p>@lang('public.date'): <input type="text" id="datepicker"></p>
        <div id="noDataErrorMessage" style="display:none;">
            <div class="d-flex flex-column align-items-center gap-2">
                <img src="../public/images/no-data.png" style="width: 80px;height:80px" />
                <p style="text-align: center;color:red">対象データが見つかりませんでした。</p>
            </div>
        </div>
        <div id="tabel_wrapper">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr class="table-secondary text-center">
                        <th scope="col">@lang('public.no')</th>
                        <th scope="col">@lang('public.name')</th>
                        <th scope="col">@lang('public.age')</th>
                        <th scope="col">@lang('public.roll_no')</th>
                        <th scope="col">Registered Date</th>
                        <th scope="col">@lang('public.delete')</th>
                    </tr>
                </thead>
                <tbody></tbody>
                
            </table>
            <!-- Modal -->
            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                            <i class="bi bi-x-lg" style="cursor:pointer" data-bs-dismiss="modal"></i>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this student?</p>
                        </div>
                        <div class="modal-footer">                            
                            <button type="button" class="btn btn-danger" name="yes" id="yes">Yes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/students/view',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'roll_no', name: 'roll_no'},
            {data: 'age', name: 'age'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    var id;
    $(document).on('click','.delete',function(){
        id=$(this).attr('id');
        $("#deleteConfirmModal").modal('show');
    });
    $('#yes').click(function(){
        $.ajax({
            type: 'GET',
            url:"/students/delete/",          
            data:{'id':id},
            dataType: "json",
            beforeSend:function(){
                $('#yes').text('Deleting...');
            },
            success:function(data){
               setTimeout(function(){
                $('#deleteConfirmModal').modal('hide');
                $('.user_datatable').DataTable().ajax.reload();
               },2000);
            }

        })
    })
    })
</script>
@endsection