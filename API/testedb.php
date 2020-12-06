<?php

//test_api.php
include('./models/userModel.php');
header('Content-Type: application/json;charset=utf-8');

$user_object = new User();
$data = ['Error'];

if(isset($_GET['action'])){
    $g = $_GET;
    if($g['action']=='validate')
        if($user_object->validate_user_by_nick($g["n"], $g["s"]))
            $data = array('success'=>'1');
    
    if($g['action']=='create'){
        if($user_object->create_user($g["n"], $g['e'], $g["s"]))
            $data = array('success'=>'1');

    }
    if($g['action']=='pass'){
         if($user_object->validate_password($g["s"]))
            $data = array('success'=>'1');

    }
}

unset($user_object);
echo json_encode($data);


