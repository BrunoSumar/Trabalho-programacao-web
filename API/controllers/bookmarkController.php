<?php
include('../api.php');
include('../models/thumbnailModel.php');
include('../models/tagModel.php');
header('Content-Type: application/json;charset=utf-8');

$api_object = new API();
$thumb_object = new Thumbnail();
$tag_object = new TAG();
$data = ['Error'];

if (isset($_GET["action"])) {
    if ($_GET["action"] == 'insert') {
        $result = $thumb_object->create_insert_thumbnail($_POST['url']);
        $thumb_id = $result[0]['success'] === '1' ? $result[0]['id'] : null;
        
        $form_data = array(
            $_POST['id'], //Id fixo temporário até termos um sistema de usuários
            $thumb_id, // || de thumbs
            $_POST['title'],
            $_POST['isPublic'] ? 0:1,
            $_POST['notes'],
            $_POST['url']
        );
        $data = $form_data;
        $tags = explode(' ', $_POST['tags']);
        $data = $api_object->insert_bookmark($form_data);
        $bookmark_id = $data[0]['bookmark_id'];
        // print_r($data[0]['bookmark_id']);
        foreach ($tags as $tag) {
            $data = $tag_object->insert_tag(array($bookmark_id,$tag));
        }
    }

    if ($_GET["action"] == 'update') {
        $form_data = array(
            $_POST['thumb_id'] ? $_POST['thumb_id']:null,
            $_POST['title'],
            $_POST['isPublic'] ? 0:1,
            $_POST['notes'],
            $_POST['url'],
            $_POST['id']
        );
        $data = $api_object->update_bookmark($form_data);
    }

    if ($_GET["action"] == 'fetch_all_bookmarks') {
        $data = $api_object->fetch_all_bookmarks_by_user([$_GET['id']]);
    }

    if ($_GET["action"] == 'fetch_one_by_id') {
        $data = $api_object->fetch_one_by_id($_POST['idBookmark']);
    }

    if ($_GET["action"] == 'delete') {
        $data = $api_object->delete_bookmark($_POST['id']);
    }
}
unset($api_object);
unset($thumb_object);
echo json_encode($data);
