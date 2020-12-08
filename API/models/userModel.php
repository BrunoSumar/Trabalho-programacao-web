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
            $data = array ( 'success' => '1', 'email'=> $email, 'id' => $this->connect->lastInsertedId());
         }else{
            $data = array ( 'success' => '0' );
         }
         return $data;
    }

    public function validate_user_by_nick($nickname, $senha){
        $query =  "SELECT user_id, password, email FROM mugs.users u WHERE u.nickname = \"$nickname\";";
         $statement = $this->connect->prepare($query);
         if ($statement->execute()){
            if($row = $statement->fetch(PDO::FETCH_ASSOC)){
                if(password_verify($senha, $row['password']))
                    return array('success'=>'1', 'id'=>$row['user_id'], 'username'=>$nickname, 'email'=>$row['email']);
            }
         }
         return array('success' => '0');
    }

    public function validate_user_by_email($email, $senha){
        $query =  "SELECT user_id, password, nickname FROM mugs.users u WHERE u.email = \"$email\";";
         $statement = $this->connect->prepare($query);
         if ($statement->execute()){
            if($row = $statement->fetch(PDO::FETCH_ASSOC)){
                if(password_verify($senha, $row['password']))
                    return array('success'=>'1','id'=>$row['user_id'], 'username' => $row['nickname'], 'email'=>$email);
            }
         }
         return array('success' => '0');
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

    public function validate_nickname($nick){
        if(preg_match('/^[a-zA-Z][a-zA-Z0-9]{5,49}$/',$nick)){
        //Sequencia de min 6 max 50 caracteres alfanumericos começando com uma letra
           return true;
        }
        return false;
    }

    public function validate_email($email){
        if(strlen($email)>=6 && strlen($email)<=50 && filter_var($email, FILTER_VALIDATE_EMAIL)){
        //sequencia de min 6 max 50 caracteres e email valido
           return true;
        }
        return false;
    }

    public function validate_password($pass){
        if(preg_match('/^.{6,50}$/',$pass)){
        //sequencia de min 6 max 50 caracteres
           return true;
        }
        return false;
    }
}
