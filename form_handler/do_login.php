<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once dirname(__FILE__) . '/../backend/Session.php';
    
    $email_username = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    $pass           = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
    
    $err = null;
    try {
        $err = Session::start($email_username, $pass);
    } catch (Exception $e) {
        $err = $e->getMessage();
    }
    if (isset($err)) {
        $err = base64_encode($err);
        redirect("/login?e=$err");
        exit();
    }
    redirect("/");
    exit();
}

