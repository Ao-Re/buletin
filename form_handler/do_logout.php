<?php

require_once dirname(__FILE__) . '/../backend/Session.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect("/");
    exit();
}

Session::close();
redirect("/login");
exit();