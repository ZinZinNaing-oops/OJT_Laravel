$(document).ready(function() {
    var id;
    //successful msg hide when click cross button
    $('#dismiss').click(function() {
        $('.alert').addClass('d-none').removeClass('d-block');
    })
    //when click delet button , show modal
    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        $("#deleteConfirmModal").modal('show');
    });
    $('#yes').click(function() {
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
            "search": search,
            "info": info,
            "infoEmpty": infoEmpty,
            "lengthMenu": lengthMenu,
            "infoFiltered": infoFiltered,
            "emptyTable": emptyTable,
            "zeroRecords": zeroRecords,
            "paginate": {
                "first": first,
                "last": last,
                "next": next,
                "previous": previous
            },
        }
    });
})