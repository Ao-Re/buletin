<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once dirname(__FILE__) . '/../backend/Session.php';
    
    $email_username = htmlspecialchars($_POST["email"]);
    $pass           = htmlspecialchars($_POST["password"]);
    
    $err = null;
    try {
        $err = Session::start($email_username, $pass);
    } catch (Exception $e) {
        $err = $e->getMessage();
    }
    if (isset($err)) {
        $msg = base64_encode($err);
        header("Location: " . SITE_ROOT . "/login?msg=" . $msg);
        exit();
    }
    header("Location: " . SITE_ROOT . "/");
}

