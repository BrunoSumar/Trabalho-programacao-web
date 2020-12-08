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

    public function fetch_newest_bookmarks()
    {
        $query =  "SELECT * FROM mugs.bookmark
                   WHERE is_private=0
                   ORDER BY creation_date DESC
                   limit 0,10;";
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

    public function fetch_newest_tags()
    {
        $query =  "SELECT distinct t.name as 'nome', as 'quant'
                   FROM mugs.bookmark b inner join mugs.tag t
                   on b.bookmark_id = t.bookmark_id
                   WHERE b.is_private=0
                   ORDER BY b.creation_date DESC
                   limit 0,10;";
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

    public function fetch_week_tags()
    {
        $query =  "SELECT distinct t.name as 'nome', sum(t.name) as 'quant'
                   FROM mugs.bookmark b inner join mugs.tag t
                   on b.bookmark_id = t.bookmark_id
                   WHERE b.is_private=0
                   and b.creation_date < CURRENT_DATE-7
                   ORDER BY b.creation_date DESC
                   limit 0,10 ";
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

