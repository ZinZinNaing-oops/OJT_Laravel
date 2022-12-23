$(document).ready(function() {
    $('form input').focus(function(){
        $(this).siblings(".text-danger").hide();
        $(this).parent('.col-sm-9').find('.is-invalid').removeClass('is-invalid');
    })
})