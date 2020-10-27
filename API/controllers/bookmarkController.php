<?php
include('../api.php');
header('Content-Type: application/json;charset=utf-8');

$api_object = new API();
$data = 'Error';

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

//print_r($data);
unset($api_object);
echo json_encode($data);
