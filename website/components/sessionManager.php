<?php

session_start();
/*Variáveis de sessão
 *
 * logged: se o usuário está logado
 * id: id do usário
 * MBversion: codigo para verificar se o conteudo exibido na página mybookmaks está atualizado
 *
 */
$s = $_SESSION;
if(isset($s['logged']) && $s['logged']=true){
    /*
     *
     *
     *
     */
}else{
    $s['logged']=false;
    $s['id']=null;
    /*    Talvez redirecionar para home     */
}

if(!isset($s['MBversion'])
    $s['MBversion'] = mt_rand();
