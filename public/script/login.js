var valid = {
    email: !!$('#inputEmail').val(),
    pass: false,
}
$('#inputEmail').on('input', function(e) {
    var email = $(this).val();
    if(email.length === 0) {
        $(this).addClass('is-invalid');
        $('#email-invalid').html('Email or username cannot be empty');
        setFormValid('email', false);
        return;
    }
    $(this).removeClass('is-invalid');
    setFormValid('email', true);
});
$('#inputPassword').on('input', function(e) {
    var password = $(this).val();
    if(password.length === 0) {
        $(this).addClass('is-invalid');
        $('#password-invalid').html('Password cannot be empty');
        setFormValid('pass', false);
        return;
    }
    $(this).removeClass('is-invalid');
    setFormValid('pass', true);
});
function setFormValid(key, flag) {
    valid[key] = flag;
    $('#login-submit').prop('disabled', !(valid.email && valid.pass));
}