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
        $uniqid = uniqid('img_', true);
        $command = 'export LD_LIBRARY_PATH="/usr/local/lib";/usr/local/bin/wkhtmltoimage --height 1080 --width 1920  '.$url.' ../thumb/'.$uniqid.'.jpg ';
        system($command, $output);
        if ($output == 0) {
            $data[] = array(
            'success' => '1',
            'path_img' => '/thumb/'.$uniqid.'.jpg '
            );
        } else {
            $data[] = array(
            'success' => '0'
            );
        }
        return($data);
    }
    
    public function insert_thumbnail($inserts)
    {
        $query =  "INSERT INTO mugs.thumbnail (path_img)
        	       VALUES (?);";
        
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
