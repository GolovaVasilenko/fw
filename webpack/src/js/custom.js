jQuery(document).ready(function($) {

    $("#form-registration").validate({
        rules: {
            login: {
                required: true,
                minlength: 2
            },
            password: {
                required: true
            },
            confirm_password: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            login: {
                required: 'Это поле обязательно для заполнения',
                minlength: 'Поле должно содержать более 2 символов'
            },
            email: {
                required: "Это поле обязательно для заполнения",
                email: "Введите корректный формат E-mail"
            }
        }
    });

});