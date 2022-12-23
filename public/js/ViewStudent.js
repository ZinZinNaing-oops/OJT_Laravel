$(document).ready(function() {
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('#user_datatable').DataTable({
        processing: true,
        lengthChange:false,
        serverSide: true,
        searching: false,
        ajax: {
            url: "{{ url('/students/view_student_list/') }}",
            type: 'GET',
            data: function(d) {
                d.date = $('#date').val();
            }
        },
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
        ],
        language: {
            "search": "{{ __('public.search') }}",
            "info": "{{ __('public.info') }}",
            "infoEmpty": "{{ __('public.infoEmpty') }}",
            "lengthMenu":"{{ __('public.lengthMenu') }}" ,
            "infoFiltered":"{{ __('public.infoFiltered') }}",
            "emptyTable": "{{ __('public.emptyTable') }}",
            "zeroRecords":"{{ __('public.zeroRecords') }}",
            "paginate": {
                "first": "{{ __('public.first') }}",
                "last":"{{ __('public.last') }}" ,
                "next":"{{ __('public.next') }}",
                "previous":"{{ __('public.previous') }}"
            },
        }
       
    });
    $('#date').change(function() {
        $('#user_datatable').DataTable().draw(true);
    })
})