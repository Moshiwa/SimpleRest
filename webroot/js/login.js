$(document).ready(function () {
    $(document).on('click', '.js-btn-login', function(e) {
        let pass = $('.js-password').val();
        let username = $('.js-username').val();

        $.ajax({
            url: "/api/objects/user/create.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({"method": "login","password":pass, "username": username}),
            success: function (response) {
                if (typeof response.error !== "undefined") {
                    if (response.error.length > 0) {
                        alert(response.error);
                    }
                }
                console.log(response)
            }
        })
    });


    $(document).on('click', '.js-toggle-register-form', function (e) {
        let registerForm = $('.form-register');
        let loginForm = $('.login-form-js');
        if (registerForm.hasClass('hidden')) {
            registerForm.removeClass('hidden');
            loginForm.addClass('hidden');
        } else {
            registerForm.addClass('hidden');
            loginForm.removeClass('hidden');
        }
    });

});