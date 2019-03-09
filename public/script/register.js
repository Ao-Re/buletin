var valid = {
  email: false,
  name: false,
  username: false,
  pass: false,
  confirm: false,
  captcha: false
};
$('#email').on('input', function(e) {
  var email = $(this).val();
  var err = null;
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!email) {
    err = 'Email cannot be empty';
  } else if (!re.test(String(email).toLowerCase())) {
    err = 'Invalid email';
  } else if (email.length > 50) {
    err = 'Email address too long (max. 50 chars)';
  }
  if (err) {
    $(this).addClass('is-invalid');
    $('#email-invalid').html(err);
    setFormValid('email', false);
    return;
  }
  $(this).removeClass('is-invalid');
  setFormValid('email', true);
});
$('#name').on('input', function(e) {
  var name = $(this).val();
  var err = null;
  if (!name) {
    err = 'Name cannot be empty';
  } else if (name.length > 50) {
    err = 'Name cannot exceed 50 characters';
  }
  if (err) {
    $(this).addClass('is-invalid');
    $('#name-invalid').html(err);
    setFormValid('name', false);
    return;
  }
  $(this).removeClass('is-invalid');
  setFormValid('name', true);
});
$('#username').on('input', function(e) {
  var username = $(this).val();
  var err = null;
  var re = /^[a-z0-9]+$/i;
  if (!username) {
    err = 'Username cannot be empty';
  } else if (username.length > 50 || username.length < 4 || !re.test(username)) {
    err = 'Username must be 4-50 alphanumeric characters';
  }
  if (err) {
    $(this).addClass('is-invalid');
    $('#username-invalid').html(err);
    setFormValid('username', false);
    return;
  }
  $(this).removeClass('is-invalid');
  setFormValid('username', true);
});
$('#password').on('input', function(e) {
  var password = $(this).val();
  var err = null;
  if (!password) {
    err = 'Password cannot be empty';
  } else if (password.length > 30 || password.length < 6) {
    err = 'Password should be 6-30 characters';
  }
  if (err) {
    $(this).addClass('is-invalid');
    $('#password-invalid').html(err);
    setFormValid('pass', false);
    return;
  }
  $(this).removeClass('is-invalid');
  setFormValid('pass', true);
});
$('#confirmPassword').on('input', function(e) {
  var confirm = $(this).val();
  var password = $('#password').val();
  var err = null;
  if (confirm !== password) {
    err = 'Passwords do not match';
  }
  if (err) {
    $(this).addClass('is-invalid');
    $('#confirm-invalid').html(err);
    setFormValid('confirm', false);
    return;
  }
  $(this).removeClass('is-invalid');
  setFormValid('confirm', true);
});
function captcha() {
  setFormValid('captcha', grecaptcha.getResponse().length !== 0);
}
function setFormValid(key, flag) {
  valid[key] = flag;
  $('#register-submit').prop(
    'disabled',
    !(valid.email && valid.name && valid.username && valid.pass && valid.confirm && valid.captcha)
  );
}
