<?php
    include_once './form_handler/do_login.php';
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login | Buletin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/signin.css">
</head>

<body class="text-center">
    <form class="form-signin" method="POST">
        <h1 class="h3 mb-5 display-4">Login to Buletin</h1>
        <label for="inputEmail" class="sr-only">Email or username</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Email or username" name="email" required autofocus/>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"
            required="" />
        <?php if (isset($_GET["msg"])): ?>
        <strong class="text-danger"><?php echo htmlspecialchars(base64_decode($_GET["msg"])) ?></strong>
        <?php endif; ?>
        <button class="btn btn-info btn-block mt-3" type="submit">Log in</button>
        <small>Don't have an account? <a href="register">Create one</a></small>

    </form>

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