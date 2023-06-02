<?php
require_once "../../database/funcBanco.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idUsuario"]) && isset($_POST["nome"]) && isset($_POST["email"])) {
        $idUsuario = $_POST["idUsuario"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        if (atualizarUsuario($idUsuario, $nome, $email)) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Falha ao atualizar o usuário.";
        }
    }
}
?>
