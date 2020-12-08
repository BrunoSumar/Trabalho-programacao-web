<?php
class TAG
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
    public function fetch_all_by_id($vars)
    {
        $query =  "SELECT * FROM mugs.tag WHERE mugs.tag.bookmark_id = ? ORDER BY tag_id";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($vars)) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //Retorna os dados de um bookmark pelo ID
    public function fetch_one_by_id($id)
    {
        $data = '';
        $id = array($id);
        $query =  "SELECT * FROM mugs.bookmark WHERE bookmark_id = ?";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($id)) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function insert_tag($inserts)
    {
        $query =   "INSERT INTO mugs.tag (bookmark_id, name)  VALUES (?,?);";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($inserts)) {
            $data[] = array(
            'success' => '1'
            );
        } else {
            $data[] = array(
            'success' => '0'
            );
        }
        return $data;
    }
}
