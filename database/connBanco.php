<?php
function connBanco(){
    $servidorBanco = "172.17.0.2";
    $usuarioBanco = "root";
    $senhaBanco = "123";
    $nomeBanco = "php";

    // Cria a conexão
    $conexao = new mysqli($servidorBanco, $usuarioBanco, $senhaBanco, $nomeBanco);

    // Verifica se ocorreu algum erro na conexão
    if ($conexao->connect_errno) {
        die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }
    else {
        
    }

    // Configura o conjunto de caracteres para UTF-8
    $conexao->set_charset("utf8");

    // Retorna a conexão estabelecida
    return $conexao;
}
?>

