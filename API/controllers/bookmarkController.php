<?php
include('../api.php');
header('Content-Type: application/json;charset=utf-8');

$api_object = new API();
$data = 'Error';

if (isset($_GET["action"])) {

    if ($_GET["action"] == 'insert') {
        $form_data = array(
            1, //Id fixo temporário até termos um sistema de usuários
            null, // || de thumbs
            $_POST['title'],
            $_POST['isPublic'] ? 0:1,
            $_POST['notes'],
            $_POST['url']
        );
        $data = $form_data;
        $data = $api_object->insert_bookmark($form_data);
    }

    if ($_GET["action"] == 'update') {
        $form_data = array(
            null, //Id fixo temporário até termos um sistema de usuários
            $_POST['title'],
            $_POST['isPublic'] ? 0:1,
            $_POST['notes'],
            $_POST['url'],
            $_POST['id']
        );
        $data = $form_data;
        $data = $api_object->update_bookmark($form_data);
    }

    if ($_GET["action"] == 'fetch_all_bookmarks') {
        $data = $api_object->fetch_all_bookmarks();
    }

    if ($_GET["action"] == 'fetch_one_by_id') {
        $data = $api_object->fetch_one_by_id($_POST['idBookmark']);
    }

}
unset($api_object);
echo json_encode($data);
