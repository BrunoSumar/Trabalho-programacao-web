<?php

session_start();

if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case 'insert':
            $form_data = array(
                'username' => $_SESSION['username'],
                'id' => $_SESSION['id'],
                'title' => $_POST['titleBookmark'],
                'notes' => $_POST['notesBookmark'],
                'url' => $_POST['urlBookmark'],
                'tags' => $_POST['tags'],
                'isPublic' => isset($_POST['isPublic']) ? 1:0
            );
            $api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/controllers/bookmarkController.php?action=insert";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            $result = json_decode($response, true);
            print_r($response);
            // print_r($result);
            
            foreach ($result as $keys => $values) {
                if ($result[$keys]['success'] == '1') {
                    echo 'Inserted';
                    $_SESSION['MBversion']=md5(1.3*time());
                } else {
                    echo 'Insert error';
                }
            }
            break;


        case 'fetch_one_by_id':
            $form_data = array( 'idBookmark' => $_POST['id']);
            $api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/controllers/bookmarkController.php?action=fetch_one_by_id";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            $result = json_decode($response, true);
            echo $response;
            break;

        case 'update':
            $form_data = array(
                'id' => $_POST['hidden_id'],
                'title' => $_POST['titleBookmark'],
                'notes' => $_POST['notesBookmark'],
                'url' => $_POST['urlBookmark'],
                'isPublic' => isset($_POST['isPublic']) ? 1:0,
                'thumb_id' => isset($_POST['thumb_id'])? null:$_POST['thumb_id'] ,
                
            );
            // print_r($form_data);
            $api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/controllers/bookmarkController.php?action=update";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            $result = json_decode($response, true);
            // print_r($response);
            foreach ($result as $keys => $values) {
                if ($result[$keys]['success'] == '1') {
                    echo 'Updated';
                    $_SESSION['MBversion']=md5(1.3*time());
                } else {
                    echo 'Update error';
                }
            }
            break;

        case 'delete_by_id':
            $form_data = array(
                'id' => $_POST['id']
            );
            $api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/controllers/bookmarkController.php?action=delete";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            $result = json_decode($response, true);
            //print_r($response);
            foreach ($result as $keys => $values) {
                if ($result[$keys]['success'] == '1') {
                    echo 'Deleted';
                    $_SESSION['MBversion']=md5(1.3*time());
                } else {
                    echo 'Delete error';
                }
            }
            break;

        case 'is_update':
            if (!isset($_SESSION['MBversion'])) {
                $_SESSION['MBversion']=md5(1.3*time());
            }
            echo $_SESSION['MBversion'];
            break;


        default:
            echo 'No Data Found';
            break;
    }
}
