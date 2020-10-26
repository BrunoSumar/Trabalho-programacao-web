<?php

//fetch.php

$api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);
//print_r $result;
$output = '';

if (count($result) > 0) {
    foreach ($result as $row) {
        $output .= '
  <tr>
   <td>'.$row->nickname.'</td>
   <td>'.$row->email.$row->password.'</td>
   <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->user_id.'">Edit</button></td>
   <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->user_id.'">Delete</button></td>
  </tr>
  ';
    }
} else {
    $output .= '
 <tr>
  <td colspan="4" align="center">No Data Found</td>
 </tr>
 ';
}
echo $output;
curl_close($client);
