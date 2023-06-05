$(document).ready(function() {
    $('#log-in').validate({
        errorClass: 'text-red-500',
        rules: {
            // name of the form atr of "name"
            email: {
                required: true,
                email: true,
                maxlength: 320
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 255
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    })
    $('#sign-up').validate({
        errorClass: 'text-red-500',
        rules: {
            name: {
                required: true,
                maxlength: 320
            },
            email: {
                required: true,
                email: true,
                maxlength: 320
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 255
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    })
})