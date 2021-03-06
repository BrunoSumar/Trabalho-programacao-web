<?php
class API
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

    public function fetch_all_bookmarks()
    {
        $query =  "SELECT * FROM mugs.bookmark ORDER BY creation_date";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function fetch_all_bookmarks_by_user($user)
    {
        $query =  "SELECT * FROM mugs.bookmark WHERE mugs.bookmark.user_id = ? ORDER BY creation_date";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($user)) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }


    //Retorna os dados de um bookmark pelo ID
    public function fetch_one_by_id($id)
    {
        $data = [];
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

    public function fetch_bookmarks($title, $isPrivate, $url)
    {
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

    public function update_bookmark_all($b_id, $u_id, $t_id, $creation_date, $title, $is_private, $notes, $url)
    { // temporario enquanto nao tem classe bookmark
        $query =  "UPDATE mugs.bookmark
                   SET  user_id = ?, thumb_id = ?, creation_date = ?, title = ?, is_private = ?, notes = ?, url = ?
                   WHERE bookmark_id = ?;";
        $statement = $this->connect->prepare($query);
        if ($statement->execute([ $u_id, $t_id, $creation_date, $title, $is_private, $notes, $url, $b_id])) {
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

    public function update_bookmark($update)
    {
        $query =    "UPDATE mugs.bookmark
                    SET  thumb_id = ?, title = ?, is_private = ?, notes = ?, url = ?
                    WHERE bookmark_id = ?;";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($update)) {
            $data[] = array(
            'success' => '1'
            );
        } else {
            $data[] = array(
            'success' => '0'
            );
        }
        $this->update_version();
        return $data;
    }

    public function insert_bookmark($inserts)
    {
        $query =  "INSERT INTO mugs.bookmark (user_id,thumb_id,title,is_private,notes,url)
	               VALUES (?,?,?,?,?,?);";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($inserts)) {
            $data[] = array(
            'success' => '1',
            'bookmark_id' =>  $this->connect->lastInsertId(),
            );
        } else {
            $data[] = array(
            'success' => '0'
            );
        }
        return $data;
    }

    public function get_version()
    {
        $query = "SELECT * FROM mugs.version;";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            $data =  ($statement->fetch(PDO::FETCH_ASSOC));
            return $data['atual'];
        }
        return null;
    }

    public function update_version()
    {
        $version = rand();
        $query = "Update mugs.version SET atual =".$version.";";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
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

    public function delete_bookmark($id)
    {
        $query = "DELETE FROM mugs.bookmark WHERE bookmark_id= ?;";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($id)) {
            $data[] = array(
            'success' => '1'
            );
        } else {
            $data[] = array(
            'success' => '0'
            );
        }
        $this->update_version();
        return $data;
    }

    public function insert_tag($inserts)
    {
        $query =   "INSERT INTO mugs.tag (tag_id,bookmark_id,name)  VALUES (?,?,?);";
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
