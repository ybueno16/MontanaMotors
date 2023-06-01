<?php
require_once 'connBanco.php';
require_once 'funcBanco.php';


connBanco();
verificarLogin($conexao);
//cadastroUsuario("teste5","teste@12345","123");
atualizarUsuario("teste2","teste@12345","1234");

?>