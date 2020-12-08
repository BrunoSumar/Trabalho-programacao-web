<?php

//session_destroy();
if (isset($_SESSION['loginNonce']) && ARGS_URL[1]==$_SESSION['loginNonce']) {
    $_SESSION['logged'] = true;
    print_r($_SESSION);
    unset($_SESSION['loginNonce']);
    // include __DIR__."/../mybookmarks.html";
    header('Location: http://localhost/UFF/Trabalho-programacao-web1/website/mybookmarks');
} else {
    header('Location: http://localhost/UFF/Trabalho-programacao-web1/website/login');
    // include __DIR__."/../home.html";
}
