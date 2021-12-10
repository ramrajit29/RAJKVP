function signup_func() {
    var table = '<div id="content_holder"><span class="loading">Loading...<span></div>';
    div = bootbox.dialog({
        message: table,
        onOpen: function () {
            $.post('signup.php', function (data, status) {
                $("#content_holder").html(data);
            });
        }
    }).attr("id", "new_popup");
}

function forgot_pass_func() {
    var table = '<div id="content_holder"><span class="loading">Loading...<span></div>';
    div = bootbox.dialog({
        message: table,
        onOpen: function () {
            $.post('forgot_password.php', function (data, status) {
                $("#content_holder").html(data);
            });
        }
    }).attr("id", "new_popup");
}


function login_func() {

    var error = 0;
    var username = $('#user_name_val').val();
    var pass_word = $('#user_pass_val').val();

    if ($('#user_name_val').val() == '') {
        $('#user_name_val').css('border-color', '#FF0000');
        error++;
    } else {
        $('#user_name_val').css('border-color', '');
    }

    if ($('#user_pass_val').val() == '') {
        $('#user_pass_val').css('border-color', '#FF0000');
        error++;
    } else {
        $('#user_pass_val').css('border-color', '');
    }

    if (error == 0) {
        $.post('submit_login.php', { username: username, pass_word: pass_word }, function (data) {
            $('#login_status').html(data);
        });
    }
}