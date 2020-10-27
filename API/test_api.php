<?php

//test_api.php
header('Content-Type: application/json;charset=utf-8');
include('api.php');

$api_object = new API();
$data = 'Error';

if ($_GET["action"] == 'fetch_all') {
    $data = $api_object->fetch_all();
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
