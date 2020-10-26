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

    public function fetch_all_bookmarks(){
        $query =  "SELECT * FROM mugs.bookmark ORDER BY creation_date";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function fetch_bookmarks($title, $isPrivate, $url){
        $query =  "SELECT * FROM mugs.bookmark WHERE ".
                   ($title !== null? " title LIKE \"%".$title."%\"":"").
                   ($isPrivate !== null? " is_private =".$isPrivate:"").
                   ($url !== null? " url LIKE %".$url."%":"").
                   " ORDER BY creation_date;";
        echo $query;
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            $data = null;
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
