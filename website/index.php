<?php
// Diz que a requisição passou por essa página (index.php)
define('INDEX_LOAD', 1);
$routeFile = '';

// Inicia sessão
include_once("./components/sessionManager.php");

// Pega as possíveis rotas do GET
define('ARGS_URL', explode("/", isset($_GET["url"]) ? $_GET["url"] : "home"));


echo $_SESSION['id']."xxxxxxxxxxx";

// Define o html padrão caso esteja no root ou não tenha o parâmetro URL
    if (is_countable(ARGS_URL) && count(ARGS_URL)==0 || ARGS_URL == "home") {
        $routeFile = "home.html";
    } elseif (!$_SESSION['logged'] && !(ARGS_URL[0] == "newuser") && (ARGS_URL[0] != "validatelogin")) {
        $routeFile = "controllers/login.php";
    } elseif (is_countable(ARGS_URL) && count(ARGS_URL) > 0) {
        $routeFile = "controllers/".ARGS_URL[0].".php";
    }


    // Chama o arquivo caso exista, caso não retorna o html padrão
    if (file_exists($routeFile)) {
        require_once $routeFile;
    } else {
        require_once "home.html";
    }




































//print_r($_GET);
//print_r($_POST);
//print_r(ARGS_URL);
