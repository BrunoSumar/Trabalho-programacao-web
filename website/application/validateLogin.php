<?php

if(isset($_POST)){
    switch ($_POST["action"]) {
        case 'insert':
            $form_data = array(
                'identifier' => $_POST['identifier'],
                'password' => $_POST['password'],
            );
            // print_r ($form_data);
            $api_url = "http://localhost/UFF/Trabalho-programacao-web1/API/controllers/userController.php?action=validate";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            $result = json_decode($response, true);


            // foreach ($result as $keys => $values) {
            //     if ($result[$keys]['success'] == '1') {
            //         $s['loginNoce'] = md5(time());
            //         echo ;
            //     } else {
            //         $
            //         echo 'Usuário ou senha incorretos.';
            //     }
            // }
            break;
    }
}
