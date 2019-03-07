<?php
class DBConnection {
    public function __construct() {
        $DB_HOST     = DB_HOST;
        $DB_PASSWORD = DB_PASSWORD;
        $DB_NAME     = DB_NAME;
        $DB_USER     = DB_USER;
        $constr      = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $DB_HOST, $DB_NAME);
        try {
            $this->pdo = new PDO($constr, $DB_USER, $DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function __destruct() {
        $this->pdo = null;
    }
}