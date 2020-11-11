<?php
include '../models/thumbnailModel.php';
header('Content-Type: application/json;charset=utf-8');

$thumb_object = new Thumbnail();
$data = ['Error'];

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'create':
            if (isset($_GET['url'])) {
                $data = $thumb_object->create_insert_thumbnail($_GET['url']);
            }
            break;
        case 'fetch_one_by_id':
            if (isset($_GET['idThumb'])) {
                $data = $thumb_object->fetch_one_by_id($_GET['idThumb']);
            }
            break;
        
        default:
            $data = ['Undefined Action'];
            break;
    }
}

// print_r($data);
echo json_encode($data);
