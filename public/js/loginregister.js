$(document).ready(function () {

    // Password Hide Show
    var eyeState = 0;
    $('#eye').click(function (e) {
        e.preventDefault();
        if (eyeState === 0) {
            $('#eye i').removeClass('fa-eye-slash')
            $('#eye i').addClass('fa-eye')
            $('#password').attr('type', 'text')
            $('#password_confirmation').attr('type', 'text')
            eyeState++;
        }
        else {
            $('#eye i').removeClass('fa-eye')
            $('#eye i').addClass('fa-eye-slash')
            $('#password').attr('type', 'password')
            $('#password_confirmation').attr('type', 'password')
            eyeState--;
        }
    });


});
