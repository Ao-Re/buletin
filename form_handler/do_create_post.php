<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once dirname(__FILE__) . '/../backend/Buletin_DBConnection.php';

    $content = isset($_POST['content']) ? escape($_POST['content']) : '';

    $captcha      = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;
    $ip           = $_SERVER['REMOTE_ADDR'];
    $response     = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=$captcha&remoteip=$ip");
    $responseKeys = json_decode($response, true);

    $db_conn = new Buletin_DBConnection();

    $err = array();

    $prev            = array();
    $prev['content'] = substr($content, 0, 500);

    // validate content
    if (empty($content)) {
        $err['content'] = "Post cannot be empty";
    } else if(strlen($content) > 300) {
        $err['content'] = "Post cannot exceed 300 characters";
    }
    // validate captcha
    if (intval($responseKeys["success"]) !== 1) {
        $err['captcha'] = "Invalid captcha";
    }
    if (!empty($err)) {
        $err  = base64_encode(json_encode($err));
        $prev = base64_encode(json_encode($prev));
        redirect("/?e=$err&p=$prev");
        exit();
    }

    $post_params = array(
        "user_id" => $_SESSION["id"],
        "content" => $content,
    );

    try {
        $db_conn->create_post($post_params);
        redirect("/");
        exit();
    } catch (Exception $e) {
        $err           = array();
        $err['global'] = $e->getMessage();
        $err           = base64_encode(json_encode($err));
        $prev          = base64_encode(json_encode($prev));
        redirect("/?e=$err&p=$prev");
        exit();
    }
}