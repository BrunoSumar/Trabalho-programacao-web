<?php

print_r($_SESSION);
//session_destroy();
if(isset($_SESSION['loginNonce']) && ARGS_URL[1]==$_SESSION['loginNonce']){
    $_SESSION['logged'] = true;
    unset($s['loginNonce']);
    include __DIR__."/../mybookmarks.html";
}
else
    include __DIR__."/../home.html";
