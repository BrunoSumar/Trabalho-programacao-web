<?php



if (isset($_POST["action"])) {
    if ($_POST["action"] == 'insert') {
        $form_data = array(
            'title' => $_POST['titleBookmark'],
            'notes' => $_POST['notesBookmark'],
            'url' => $_POST['urlBookmark'],
            'isPublic' => isset($_POST['isPublic']) ? 1:0
        );
        // print_r ($form_data);
        $api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/controllers/bookmarkController.php?action=insert";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);

        foreach ($result as $keys => $values) {
            if ($result[$keys]['success'] == '1') {
                echo 'Inserted';
            } else {
                echo 'Insert error';
            }
        }
    }elseif ($_POST["action"] == 'update') {
        // code...
    }
}
