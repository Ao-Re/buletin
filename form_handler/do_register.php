<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once dirname(__FILE__) . '/../backend/Buletin_DBConnection.php';

    // $name     = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $email    = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm  = htmlspecialchars($_POST['confirmPassword']);

    $captcha      = $_POST['g-recaptcha-response'];
    $ip           = $_SERVER['REMOTE_ADDR'];
    $response     = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=$captcha&remoteip=$ip");
    $responseKeys = json_decode($response, true);

    $db_conn = new Buletin_DBConnection();

    $err = array();

    $prev             = array();
    $prev['username'] = $username;
    $prev['email']    = $email;

    // validate email
    if (!empty($db_conn->retrieve_email($email))) {
        $err['email'] = "An account with the same email exists";
    } elseif (!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email)) {
        $err['email'] = "Invalid email";
    } elseif (strlen($username) > 50) {
        $err['email'] = "Email address too long (max. 50 chars)";
    }
    // validate username
    if (!empty($db_conn->retrieve_username($username))) {
        $err['username'] = "Username already taken";
    } elseif (strlen($username) > 50 || strlen($username) < 4 || !preg_match('/^[a-z0-9]+$/i', $username)) {
        $err['username'] = "Username must be 4-50 alphanumeric characters";
    }
    // validate password
    if (strlen($password) > 30 || strlen($password) < 6) {
        $err['password'] = "Password should be between 5 and 30 characters";
    }
    // validate confirm
    if ($password != $confirm) {
        $err['confirm'] = "Passwords do not match";
    }
    // validate captcha
    if (intval($responseKeys["success"]) !== 1) {
        $err['captcha'] = "Invalid captcha";
    }
    if (!empty($err)) {
        $err  = base64_encode(json_encode($err));
        $prev = base64_encode(json_encode($prev));
        header("Location: " . SITE_ROOT . "/register?e=$err&p=$prev");
        exit();
    }

    $user_params = array(
        "name"     => $username,
        "username" => $username,
        "email"    => $email,
        "password" => $password,
    );

    try {
        $db_conn->create_user($user_params);
        header("Location: " . SITE_ROOT . "/");
        exit();
    } catch (Exception $e) {
        $err           = array();
        $err['global'] = $e->getMessage();
        $err           = base64_encode(json_encode($err));
        $prev          = base64_encode(json_encode($prev));
        header("Location: " . SITE_ROOT . "/register?e=$err&p=$prev");
        exit();
    }
}