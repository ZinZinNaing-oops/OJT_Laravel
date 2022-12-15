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
            <table class="table table-hover border" id="table">
                <thead>
                    <tr class="table-secondary text-center">
                        <th scope="col">@lang('public.no')</th>
                        <th scope="col">@lang('public.name')</th>
                        <th scope="col">@lang('public.age')</th>
                        <th scope="col">@lang('public.roll_no')</th>
                        <th scope="col">@lang('public.delete')</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="students_list">
                    @php ($count=1)
                    @foreach($students as $student)
                    <tr>
                        <th scope="row"> {{$count++;}}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->roll_no }}</td>
                        <td><a data-id="{{$student->id}}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" id="modal"><i class="bi bi-trash3-fill" style="font-size:15px;cursor:pointer;color:#D10000"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <form method="POST" action="/students/delete">
                                <input type="text" id="id" name="id" />
                                <button type="button" class="btn btn-primary btn-sm" id="delete">Yes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#table").DataTable({
            "searching": false,
            "lengthChange": false,
            "bAutoWidth": false
        });
        $("#modal").click(function() {
            var myId = $(this).data('id');
            $("#id").val(myId);
        });
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#datepicker').change(function() {
            $("#listTable").show();
            $("#searchResult").hide();
            $("#searchResult").empty();
            $("#noDataErrorMessage").css("display", "none");
            var date = $('#datepicker').val();
            $.ajax({
                type: 'GET',
                url: '/students/showDate/',
                dataType: "json",
                data: {
                    'date': date
                },
                success: function(data) {
                    if (data.student.length > 0) {
                        $("#noDataErrorMessage").css("display", "none");
                        $("#tabel_wrapper").show();
                        $("#students_list").show();
                        var table = $('#table').DataTable();
                        table.clear().draw();
                        for (var i = 0; i < data.student.length; i++) {
                            var delBtn = `<i class="bi bi-trash3-fill" style="font-size:15px;cursor:pointer;color:#D10000" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"></i>`;
                            table.row.add([`${i + 1}`, data.student[i].name, data.student[i].age, data.student[i].roll_no], 'ddee').draw();
                        }
                    } else {
                        $("#tabel_wrapper").hide();
                        $("#noDataErrorMessage").css("display", "block");
                    }

                }
            })
        })
    })
</script>
@endsection