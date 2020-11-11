<?php
/**
 *
 */
class Thumbnail
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
    
    public function create_thumbnail($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if (!(substr($url, 0, 4) === 'http')) {
            $url = 'http://'.$url;
        }
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $uniqid = uniqid('img_', true);
            $command = 'export LD_LIBRARY_PATH="/usr/local/lib";/usr/local/bin/wkhtmltoimage --height 1080 --width 1920  '.$url.' ../thumb/'.$uniqid.'.jpg';
            system($command, $output);
            if ($output == 0) {
                $data[] = array(
                    'success' => '1',
                    'path_img' => '/thumb/'.$uniqid.'.jpg'
                );
            } else {
                $data[] = array(
                    'success' => '0'
                );
            }
        }
        return($data);
    }
    
    public function insert_thumbnail($inserts)
    {
        $query =  "INSERT INTO mugs.thumbnail (path_img)
        	       VALUES (?);";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($inserts)) {
            $data = $this->connect->lastInsertId();
        } else {
            $data = null;
        }
        return $data;
    }
    
    public function create_insert_thumbnail($url)
    {
        $data = [];
        $data[] = array(
            'success' => '0'
        );
        $result = $this->create_thumbnail($url);
        if ($result[0]['success'] === '1') {
            $res = $this->insert_thumbnail([$result[0]['path_img']]);
            if (!is_null($res)) {
                $data = [];
                $data[] = array(
                    'success' => '1',
                    'id' => $res,
                    'path_img' => $result[0]['path_img']
                );
            }
        } else {
            $data = [];
            
            
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
    
    public function fetch_one_by_id($id)
    {
        $id = array($id);
        $query =  "SELECT * FROM mugs.thumbnail WHERE thumb_id = ?";
        $statement = $this->connect->prepare($query);
        if ($statement->execute($id)) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        $data = ['Error'];
        return $data;
    }
}
