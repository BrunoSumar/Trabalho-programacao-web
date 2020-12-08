<?php

session_start();


function httpPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

if (isset($_POST['action'])) {
    switch ($_POST["action"]) {
        case 'validate':
            $form_data = array(
                'action' => 'validate',
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
            // print_r($result);

            if ($result['success'] == '1') {
                $_SESSION['id'] = $result['id'];
                $_SESSION['loginNonce'] = md5(time());
                //Enviar aqui email com link para usuário
                $link = "http://localhost/UFF/Trabalho-programacao-web1/website/validatelogin/".$_SESSION['loginNonce'];
            }
            echo $response;
            break;
        case 'create':
            $form_data = array(
                'action' => 'create',
                'nickname' => $_POST['nickname'],
                'email' => $_POST['email'],
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
            print_r($result);

            if ($result['success'] == '1') {
                $_SESSION['id'] = $_POST['nickname'];
                $_SESSION['loginNonce'] = md5(time());
                $link = "http://localhost/UFF/Trabalho-programacao-web1/website/validatelogin/".$_SESSION['loginNonce'];
            }
            echo $response;
            break;
    }
}
