<?php
include('../api.php');

$api_object = new API();
$data = 'Error';

if ($_GET["action"] == 'fetch_all_bookmarks') {
    //$data = $api_object->fetch_all_bookmarks();
}

if ($_GET["action"] == 'insert') {
    $form_data = array(
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    );
    $data = $form_data;
}

if ($_GET["action"] == 'fetch_all_bookmarks') {
    $data = $api_object->fetch_all_bookmarks();
}

echo json_encode($data);
