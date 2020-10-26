<?php

class API
{
    private $connect = '';

    public function __construct()
    {
        $this->database_connection();
    }
    public function database_connection()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=mugs", "root", "");
    }

    public function fetch_all()
    {
        $query =  "SELECT * FROM mugs.users ORDER BY user_id";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
