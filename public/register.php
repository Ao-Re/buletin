<?php
Session::check();

require_once '../form_handler/do_register.php';
$err  = isset($_GET['e']) ? json_decode(base64_decode($_GET['e'])) : null;
$prev = isset($_GET['p']) ? json_decode(base64_decode($_GET['p'])) : null;
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>Register | Buletin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=1920">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- ReCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="d-flex flex-column h-100 bg-info">
    <?php include './navbar.php'; ?>
    <main class="flex-shrink-0 py-5" role="main">
        <div class="container" style="padding-top: 56px">
            <div class="row">
                <div class="col-md-6 text-white">
                    <h1 class="display-4 mt-lg-2">Create an account @ <span class="text-monospace">buletin</span></h1>
                </div>
                <div class="col-md-5 offset-md-1 px-sm-0">
                    <div class="card border-0 rounded-0">
                        <div class="card-body">
                            <form class="form-signin" method="POST">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" class="col-form-label col-form-label-sm" for="email">Email</label>
                                    <input type="email"
                                        class="form-control form-control-sm <?php if(isset($err) && isset($err->email)) echo "is-invalid"; ?>"
                                        value="<?php if(isset($prev)) e($prev->email) ?>" name="email" id="email"
                                        placeholder="e.g. johndoe@mail.com" required autofocus>
                                    <div class="invalid-feedback" id="email-invalid">
                                        <?php if(isset($err) && isset($err->email)) e($err->email); ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                                    <input type="name"
                                        class="form-control form-control-sm <?php if(isset($err) && isset($err->name)) echo "is-invalid"; ?>"
                                        value="<?php if(isset($prev)) e($prev->name) ?>" name="name" id="name"
                                        placeholder="e.g. John Doe" required>
                                    <div class="invalid-feedback" id="name-invalid">
                                        <?php if(isset($err) && isset($err->name)) e($err->name); ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="username">Username</label>
                                    <input type="text"
                                        class="form-control form-control-sm <?php if(isset($err) && isset($err->username)) echo "is-invalid"; ?>"
                                        value="<?php if(isset($prev)) e($prev->username) ?>" name="username"
                                        id="username" placeholder="e.g. johndoe123" required>
                                    <div class="invalid-feedback" id="username-invalid">
                                        <?php if(isset($err) && isset($err->username)) e($err->username); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label class="col-form-label col-form-label-sm" for="password">Password</label>
                                        <input type="password"
                                            class="form-control form-control-sm <?php if(isset($err) && isset($err->password)) echo "is-invalid"; ?>"
                                            name="password" id="password" placeholder="Enter your password" required>
                                        <div class="invalid-feedback" id="password-invalid">
                                            <?php if(isset($err) && isset($err->password)) e($err->password); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pt-3 pt-md-0">
                                        <label class="col-form-label col-form-label-sm" for="confirmPassword">Confirm password</label>
                                        <input type="password"
                                            class="form-control form-control-sm <?php if(isset($err) && isset($err->confirm)) echo "is-invalid"; ?>"
                                            name="confirmPassword" id="confirmPassword"
                                            placeholder="Enter your password again">
                                        <div class="invalid-feedback" id="confirm-invalid">
                                            <?php if(isset($err) && isset($err->confirm)) e($err->confirm); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY ?>" data-callback="captcha"></div>
                                    <small class="text-danger"><?php if(isset($err) && isset($err->captcha)) e($err->captcha); ?></small>
                                </div>
                                <small
                                    class="text-danger font-weight-bold"><?php if(isset($err) && isset($err->global)) e($err->global); ?></small>
                                    <button class="btn btn-info btn-block mt-3" type="submit" id="register-submit" disabled>Register</button>
                                    <small class="text-center d-block mt-3 text-muted">Already have an account? Log in
                                        <a href="login">here</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './footer.php'; ?>
    <script src="./script/register.js"></script>
</body>

</html>