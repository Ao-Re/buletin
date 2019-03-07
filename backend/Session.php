<?php
include_once 'Buletin_DBConnection.php';

class Session {
  public static function start(string $email_pass, string $password) {
    $db_conn = new Buletin_DBConnection();
    $result = $db_conn->retrieve_email_pass($email_pass, $password);
    if(empty($result)) {
      return "Invalid username or password";
    }
    session_start();
    $_SESSION["id"] = $result["id"];
    $_SESSION["username"] = $result["username"];
    $_SESSION["name"] = $result["name"];
    $_SESSION["email"] = $result["email"];
  }
  public static function close() {
    session_destroy();
  }
  public static function check(string $redirect) {
    session_start();
    if(!isset($_SESSION["id"])) {
      header("Location: ".$redirect);
      exit();
    }
  }
}