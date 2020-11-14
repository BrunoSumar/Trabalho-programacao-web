<?php
include('../models/userModel.php');
header('Content-Type: application/json;charset=utf-8');

$user_object = new User();
$data = ['Error'];

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'create') {
        $nickname = trim($_POST['nickname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $data = $user_object->create_user($nickname, $email, $password);
    }

    if ($_POST["action"] == 'validate') {
        $identifier =  trim($_POST['identifier']);
        $password = trim($_POST['password']);

        if($id = filter_var($identifier, FILTER_VALIDATE_EMAIL)){
            $data = $user_object->create_validate_by_email($id, $password);
        }else{
            $data = $user_object->create_validate_by_nick($identifier, $password);
        }
    }

    if ($_POST["action"] == 'check_nick') {
        $nickname = $_POST['nickname'];

        $data = $user_object->is_nickname_avaible($nickname);
    }

    if ($_POST["action"] == 'check_email') {
        $email = $_POST['email'];

        $data = $user_object->is_email_avaible($email);
    }

}

unset($user_object);
echo json_encode($data);
