<?php

//session_destroy();
if (isset($_SESSION['loginNonce']) && ARGS_URL[1]==$_SESSION['loginNonce']) {
    $_SESSION['logged'] = true;
    //unset($_SESSION['loginNonce']);
    header('Location: http://localhost/UFF/Trabalho-programacao-web1/website/mybookmarks');
} else {
    header('Location: http://localhost/UFF/Trabalho-programacao-web1/website/login');
}
