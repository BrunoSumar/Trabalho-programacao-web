<?php

if (!(defined('INDEX_LOAD') && INDEX_LOAD == 1)) { // Verifica se chamada veio de index.php
    exit("Acesso inválido.");
}

// Inicia sessão
session_start();

/*/
 * Variáveis de sessão
 *
 * logged: se o usuário está logado
 * id: id do usário
 * MBversion: codigo para verificar se o conteudo exibido na página mybookmaks está atualizado
 * loginNonce: gerado apenas ao realizar login para verificação de duas etapas
 *
/*/


if (!isset($_SESSION['logged']) || $_SESSION['logged']==false) {
    $_SESSION['logged']=false;
    $_SESSION['id']=null;
}
