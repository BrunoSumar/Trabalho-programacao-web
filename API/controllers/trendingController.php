<?php

include('../api.php');
include('../models/trendingModel.php');
header('Content-Type: application/json;charset=utf-8');

$trend_object = new Trending();
$data = ['Error'];

if (isset($_GET["action"])) {
    if($_GET['action']=='newBookmarks'){
        $data = $trend_object->fetch_newest_bookmarks();
    }else

    if($_GET['action']=='newTags'){
        $data = $trend_object->fetch_newest_tags();
    }else

    if($_GET['action']=='weekTags'){
        $data = $trend_object->fetch_week_tags();
    }


}
unset($trend_object);
echo json_encode($data);
