<?php
Session::check("/", false);

require_once '../form_handler/do_login.php';
$err  = isset($_GET["e"]) ? base64_decode($_GET["e"]) : null;
$prev = isset($_GET['p']) ? json_decode(base64_decode($_GET['p'])) : null;
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <title>Login | Buletin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=1920">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100 bg-info">
    <?php include './navbar.php'; ?>
    <main class="flex-shrink-0 py-5" role="main">
        <div class="container" style="padding-top: 56px">
            <div class="row">
                <div class="col-md-6 text-white">
                    <h1 class="display-4 mt-lg-2">Log in to <span class="text-monospace">buletin</span></h1>
                </div>
                <div class="col-md-4 offset-md-1 px-sm-0">
                    <div class="card border-0 rounded-0 px-2 py-4">
                        <div class="card-body">
                            <form class="form-signin" method="POST">
                                <div class="form-group">
                                    <label for="inputEmail" class="sr-only">Email or username</label>
                                    <input type="text" id="inputEmail" class="form-control"
                                        placeholder="Email or username" name="email"
                                        value="<?php if (isset($prev)) e($prev->email);?>" required autofocus />
                                    <div class="invalid-feedback" id="email-invalid"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="sr-only">Password</label>
                                    <input type="password" id="inputPassword" class="form-control"
                                        placeholder="Password" name="password" required="" />
                                    <div class="invalid-feedback" id="password-invalid"></div>
                                </div>
                                <?php if (isset($err)): ?>
                                <strong class="text-danger"><?php e($err); ?></strong>
                                <?php endif; ?>
                                <button class="btn btn-info rounded-pill btn-block mt-3" type="submit" id="login-submit"
                                    disabled>Log in</button>
                                <small class="d-block text-center mt-2">Don't have an account? <a href="register">Create
                                        one</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './footer.php'; ?>
    <script src="./script/login.js"></script>
</body>

</html>