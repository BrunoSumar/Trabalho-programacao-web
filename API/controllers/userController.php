<?php
include('../models/userModel.php');
header('Content-Type: application/json;charset=utf-8');

$user_object = new User();
$data = ['Error'];

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'create') {
        $nick = isset($_POST['nickname'])?$_POST['nickname']:"";
        $email = isset($_POST['email'])?$_POST['email']:"";
        $pass = isset($_POST['password'])?$_POST['password']:"";

        if($user_object->is_nickname_avaible($nick) && $user_object->is_email_avaible($email)){
            if($user_object->validate_nickname($nick) && $user_object->validate_email($email) && $user_object->validate_password($password))
                $data = $user_object->create_user($nick, $email, $pass);
        }
        else
            $data = array('success' => '0');
    }else

    if ($_POST["action"] == 'validate') {
        $id= isset($_POST['identifier'])?$_POST['identifier']:"";
        $pass = isset($_POST['password'])?$_POST['password']:"";

        if($user_object->validate_password($pass)){
            if($user_object->validate_email($id)){
                if($user_object->validate_user_by_email($id, $pass))
                    $data = array('success' => '1');
            }else
            if($user_object->validate_nickname($id)){
                if($user_object->validate_user_by_nick($id, $pass))
                    $data = array('success' => '1');
            }
        }
        if(isset($data['success'])){

        }
        else
            $data = array('success' => '0');

    }else

    if ($_POST["action"] == 'check_nick') {
        $nick = isset($_POST['nickname'])?$_POST['nickname']:"";

        if($user_object->is_nickname_avaible($nickname))
            $data = array('success' => '1');
        else
            $data = array('success' => '0');
    }else

    if ($_POST["action"] == 'check_email') {
        $email= isset($_POST['email'])?$_POST['email']:"";

        if($user_object->is_email_avaible($email))
            $data = array('success' => '1');
        else
            $data = array('success' => '0');
    }

}

unset($user_object);
echo json_encode($data);
