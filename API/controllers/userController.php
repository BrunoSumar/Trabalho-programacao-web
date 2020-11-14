<?php
include('../models/userModel.php');
header('Content-Type: application/json;charset=utf-8');

$user_object = new User();
$data = ['Error'];

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'create') {
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $data = $user_object->create_user($nickname, $email, $password);
    }

    if ($_POST["action"] == 'validate') {
        $identifier =  trim($_POST['identifier']);
        $password = trim($_POST['password']);

        if(strlen($password <= 255)){
            if($id = filter_var($identifier, FILTER_VALIDATE_EMAIL)){
                $data = $user_object->create_validate_by_email($id, $password);
            }else{
                $data = $user_object->create_validate_by_nick($identifier, $password);
            }
        }
    }
}

unset($user_object);
echo json_encode($data);
