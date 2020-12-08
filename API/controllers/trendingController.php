<?php

include('../api.php');
include('../models/thumbnailModel.php');
header('Content-Type: application/json;charset=utf-8');

$api_object = new API();
$thumb_object = new Thumbnail();
$data = ['Error'];

if (isset($_GET["action"])) {
    if($_GET['action']==''){
    }else
}
