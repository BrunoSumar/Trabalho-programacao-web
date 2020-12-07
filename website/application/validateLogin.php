<?php

if(isset($_POST)){
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

            if ($result['success'] == '1') {
                $s['id'] = $result['id'];
                $s['loginNoce'] = md5(time());
                //Enviar aqui email com link para usuário
                //link no formato "/application/validateLogin.php?action=confirm&sessionHash=".$s['loginNonce']
            }
            echo $response;
            break;
    }
}else

if(isset($_GET)){
    switch ($_POST["action"]) {
        case 'confirm':
            if($_GET['sessionHash']==$s['loginNonce']){
                $s['logged'] = true;
                unset($s['loginNonce']);
                include __DIR__."/../mybookmarks.html";
            }
            break;
    }
}
