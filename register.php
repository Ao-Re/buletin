<?php
include_once './form_handler/do_register.php';
$err  = isset($_GET['e']) ? json_decode(base64_decode($_GET['e'])) : null;
$prev = isset($_GET['p']) ? json_decode(base64_decode($_GET['p'])) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register | Buletin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />

    <!-- ReCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
    html,
    body {
        height: 100%;
    }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 px-4 border-right text-right mb-0 mb-sm-5">
                <h1 class="font-weight-light mt-lg-2">Create an account @ Buletin</h1>
            </div>
            <div class="col-md-5 px-md-4 px-sm-0">
                <form class="form-signin" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                            class="form-control <?php echo (isset($err) && isset($err->email) ? "is-invalid" : ""); ?>"
                            value="<?php echo isset($prev) ? htmlspecialchars($prev->email) : '' ?>" name="email"
                            id="email" placeholder="e.g. johndoe@mail.com" required autofocus>
                        <div class="invalid-feedback">
                            <?php echo isset($err) && isset($err->email) ? htmlspecialchars($err->email) : ""; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                            class="form-control <?php echo (isset($err) && isset($err->username) ? "is-invalid" : ""); ?>"
                            value="<?php echo isset($prev) ? htmlspecialchars($prev->username) : '' ?>" name="username"
                            id="username" placeholder="e.g. johndoe123" required>
                        <div class="invalid-feedback">
                            <?php echo isset($err) && isset($err->username) ? htmlspecialchars($err->username) : ''; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password"
                                class="form-control <?php echo (isset($err) && isset($err->password) ? "is-invalid" : ""); ?>"
                                name="password" id="password" placeholder="" required>
                            <div class="invalid-feedback">
                                <?php echo isset($err) && isset($err->password) ? htmlspecialchars($err->password) : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3 pt-md-0">
                            <label for="confirmPassword">Confirm password</label>
                            <input type="password"
                                class="form-control <?php echo (isset($err) && isset($err->confirm) ? "is-invalid" : ""); ?>"
                                name="confirmPassword" id="confirmPassword" placeholder="">
                            <div class="invalid-feedback">
                                <?php echo isset($err) && isset($err->confirm) ? htmlspecialchars($err->confirm) : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY ?>"></div>
                        <small
                            class="text-danger"><?php echo isset($err) && isset($err->captcha) ? htmlspecialchars($err->captcha) : ''; ?></small>
                    </div>
                    <small
                        class="text-danger font-weight-bold"><?php echo isset($err) && isset($err->global) ? htmlspecialchars($err->global) : ''; ?></strong>
                        <button class="btn btn-info btn-block mt-3" type="submit">Register</button>
                        <small class="text-center d-block mt-3 text-muted">Already have an account? Log in <a
                                href="login">here</a></small>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>