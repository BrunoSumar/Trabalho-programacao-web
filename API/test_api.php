<?php

//test_api.php

include('api.php');

$api_object = new API();
$data = 'nada';
if($_GET["action"] == 'fetch_all')
{
 $data = $api_object->fetch_all();
}

echo json_encode($data);

?>
