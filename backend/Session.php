<?php
require_once 'Buletin_DBConnection.php';

class Session {
  public static function start(string $email_username, string $password) {
    $db_conn = new Buletin_DBConnection();
    $result = $db_conn->retrieve_email_pass($email_username, $password)[0];
    if(empty($result) || !isset($result[0])) {
      return "Invalid username or password";
    }
    session_start();
    $_SESSION["id"] = $result["id"];
    $_SESSION["username"] = $result["username"];
    $_SESSION["name"] = $result["name"];
    $_SESSION["email"] = $result["email"];
    
    $names = explode(" ", $_SESSION["name"]);
    $acronym = $names[0][0].end($names)[0];

    $_SESSION["acronym"] = strtoupper($acronym);
  }
  public static function close() {
    session_start();
    session_destroy();
  }
  public static function check(string $redirect=null) {
    session_start();
    if(isset($redirect) && !isset($_SESSION["id"])) {
      redirect($redirect);
      exit();
    }
  }
}