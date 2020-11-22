<?php

class User
{
    private $connect = '';
    private $data = '';
    public function __construct()
    {
        $this->database_connection();
    }
    public function database_connection()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=mugs;charset=utf8", "root", "");
    }

    public function create_user($nickname, $email, $password){
         $query =  "INSERT INTO mugs.users (user_id, nickname, email, password) VALUES (NULL, ?, ?, ?);";
         $statement = $this->connect->prepare($query);
         $password_hash = password_hash($password, PASSWORD_BCRYPT);;
         if ($statement->execute([$nickname, $email, $password_hash])){
            $data = array ( 'success' => '1' );
         }else{
            $data = array ( 'success' => '0' );
         }
         return $data;
    }

    public function validate_user_by_nick($nickname, $senha){
        $query =  "SELECT password FROM mugs.users u WHERE u.nickname = \"$nickname\";";
         $statement = $this->connect->prepare($query);
         if ($statement->execute()){
            if($row = $statement->fetch(PDO::FETCH_ASSOC)){
                return password_verify($senha, $row['password']);
            }
         }
         return false;
    }

    public function validate_user_by_email($email, $senha){
        $query =  "SELECT password FROM mugs.users u WHERE u.email = \"$email\";";
         $statement = $this->connect->prepare($query);
         if ($statement->execute()){
            if($row = $statement->fetch(PDO::FETCH_ASSOC)){
                return password_verify($senha, $row['password']);
            }
         }
         return false;
    }

    public function is_nickname_avaible($nickname){
        $query =  "SELECT \".\" FROM mugs.users u WHERE u.nickname = \"$nickname\";";
         $statement = $this->connect->prepare($query);
         if ($statement->execute()){
            if(!($row = $statement->fetch(PDO::FETCH_ASSOC))){
                return true;
            }
         }
         return false;
    }

    public function is_email_avaible($email){
        $query =  "SELECT \".\" FROM mugs.users u WHERE u.email = \"$email\";";
         $statement = $this->connect->prepare($query);
         if ($statement->execute()){
            if(!($row = $statement->fetch(PDO::FETCH_ASSOC))){
                return true;
            }
         }
         return false;
    }
}
