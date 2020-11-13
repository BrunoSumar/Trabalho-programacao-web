<?php
include('../models/userModel.php');
header('Content-Type: application/json;charset=utf-8');

$user_object = new User();
$data = ['Error'];

if (isset($_GET["action"])) {
}
unset($user_object);
echo json_encode($data);
