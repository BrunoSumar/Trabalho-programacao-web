<?php

//test_api.php

include('api.php');

$api_object = new API();
$data = 'nada';
if($_GET["action"] == 'fetch_all_bookmarks')
{
 $data = $api_object->fetch_all_bookmarks();
}

if($_GET["action"] == 'fetch_all')
{
 $data = $api_object->fetch_all();
}

if($_GET["action"] == 'fetch_bookmarks')
{
 $data = $api_object->fetch_bookmarks(null,1,null);
}


echo json_encode($data);

?>
