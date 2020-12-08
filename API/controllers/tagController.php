<?php
include('../models/tagModel.php');
header('Content-Type: application/json;charset=utf-8');

$tag_object = new TAG();
$data = ['Error'];

if (isset($_GET["action"])) {
    if ($_GET["action"] == 'fetch_all_by_id') {
        $data = $tag_object ->fetch_all_by_id([$_GET['idBookmark']]);
    }
}
unset($api_object);
unset($thumb_object);
echo json_encode($data);
