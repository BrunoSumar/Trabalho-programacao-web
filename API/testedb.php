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

if($_GET["action"] == 1){
    $data = $api_object->update_bookmark(2, 1, NULL, "2025-10-08 20:09:17", "abasdc",	1, "adddsd", "4.com");
}

echo json_encode($data);

?>