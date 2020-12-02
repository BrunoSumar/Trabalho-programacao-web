<?php
// Diz que a requisição passou por essa página (index.php)
define('INDEX_LOAD',1);
$routeFile = '';


// Pega as possíveis rotas do GET
define('ARGS_URL', explode("/", isset($_GET["url"]) ? $_GET["url"] : "home"));

print_r($_GET);
print_r($_POST);
print_r(ARGS_URL);

// Define o html padrão caso esteja no root ou não tenha o parâmetro URL
if (count(ARGS_URL)==0 || ARGS_URL == "home")
    $routeFile = "home.html";

// Chama o respectivo controller
if (ARGS_URL[0] === "controllers") {
    $routeFile .= "controllers/". "ARQUIVO.php";
    echo "Chamar o controller responsável



    ";
}



// Chama o arquivo caso exista, caso não retorna o html padrão
if (file_exists($routeFile)) {
    require_once $routeFile;
}else {
    require_once "home.html";
}
