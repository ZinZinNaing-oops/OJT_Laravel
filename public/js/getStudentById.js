$(document).ready(function() {
    $('#roll_no').on('change', function() {
        var selected_roll_no= $('#roll_no').val();
        if (selected_roll_no != "") {
            $.ajax({
                type: 'GET',
                url: '/students/show/',
                data:{'rollNo':selected_roll_no},
                dataType: "json",
                success: function(data) {
                    $("#name").val(data.student[0].name);
                    $("#age").val(data.student[0].age);
                }
            })
        } else {
            $("#name").val(null);
            $("#age").val(null);
        }
    })
})