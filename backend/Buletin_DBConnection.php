<?php
require_once 'DBConnection.php';
require_once 'utils.php';

class Buletin_DBConnection extends DBConnection {
    public function __construct() {
        parent::__construct();
    }
    public function __destruct() {
        parent::__destruct();
    }
    public function create_user(array $params): void{
        $sql = "INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`) VALUES (:id, :name, :username, :email, :password)";
        
        $id   = uniqid("", true);
        $pass = password_hash($params["password"], PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $params["name"]);
        $stmt->bindParam(":username", $params["username"]);
        $stmt->bindParam(":email", $params["email"]);
        $stmt->bindParam(":password", $pass);

        if (!$stmt->execute()) {
            throw new Exception("Cannot execute CREATE_USER SQL statement: ".json_encode($stmt->errorInfo()));
        }
    }

    public function retrieve_user(string $user_id): array{
        $sql = "SELECT * FROM `user` WHERE `id` = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $user_id);

        if (!$stmt->execute()) {
            throw new Exception("Cannot execute RETRIEVE_USER SQL statement: ".json_encode($stmt->errorInfo()));
        }

        $data = $stmt->fetchAll();
        return $data;
    }

    public function retrieve_email(string $email): array{
        $sql = "SELECT * FROM `user` WHERE `email` = :email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":email", $email);

        if (!$stmt->execute()) {
            throw new Exception("Cannot execute RETRIEVE_EMAIL SQL statement: ".json_encode($stmt->errorInfo()));
        }

        $data = $stmt->fetchAll();
        return $data;
    }

    public function retrieve_username(string $username): array{
        $sql = "SELECT * FROM `user` WHERE `username` = :username";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":username", $username);

        if (!$stmt->execute()) {
            throw new Exception("Cannot execute RETRIVE_USERNAME SQL statement: ".json_encode($stmt->errorInfo()));
        }

        $data = $stmt->fetchAll();
        return $data;
    }

    public function retrieve_email_pass(string $email_username, string $pass): array{
        $sql = "SELECT * FROM `user` WHERE `email` = :email OR `username` = :username";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":email", $email_username);
        $stmt->bindParam(":username", $email_username);

        if (!$stmt->execute()) {
            throw new Exception("Cannot execute RETRIEVE_EMAIL_PASS SQL statement: ".json_encode($stmt->errorInfo()));
        }

        $data = $stmt->fetchAll();
        if(empty($data)) {
            return $data;
        }

        $pass_hash = $data[0]["password"];
        if(!password_verify($pass, $pass_hash)) {
            return array();
        }

        return $data;
    }
    
    public function create_post(array $params): void{
        if(empty($this->retrieve_user($params["user_id"]))) {
            throw new Exception("User not found!");
        }
        $sql = "INSERT INTO `post` (`user_id`, `content`) VALUES (:user_id, :content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":user_id", $params["user_id"]);
        $stmt->bindParam(":content", $params["content"]);

        if (!$stmt->execute()) {
            throw new Exception("Cannot execute CREATE_POST SQL statement: ".json_encode($stmt->errorInfo()));
        }
    }

    public function retrieve_posts(int $count=-1): array {
        $sql = "SELECT * FROM `post` INNER JOIN `user` ON `post`.`user_id`=`user`.`id` ORDER BY `timestamp` DESC";
        if($count > 0) $sql = $sql." LIMIT :count";
        $stmt = $this->pdo->prepare($sql);
        if($count > 0) $stmt->bindParam(":count", $count, PDO::PARAM_INT);
        
        if (!$stmt->execute()) {
            throw new Exception("Cannot execute RETRIEVE_POSTS SQL statement: ".json_encode($stmt->errorInfo()));
        }

        return $stmt->fetchAll();
    }
}