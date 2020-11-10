<?php
include '../models/thumbnailModel.php';
header('Content-Type: application/json;charset=utf-8');

$thumb_object = new Thumbnail();
$data = 'Error';

if (isset($_GET["action"])) {
    if ($_GET["action"] == 'create') {
        if (isset($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            
            if (!(substr($url, 0, 4) === 'http')) {
                $url = 'http://'.$url;
            }
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $data = $thumb_object->create_thumbnail($url);
            } else {
                $data = [];
                $data[] = array(
                    'success' => '0'
                );
            }
        }
    }
}
unset($thumb_object);
echo json_encode($data);
