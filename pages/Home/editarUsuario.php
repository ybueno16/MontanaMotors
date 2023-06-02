<?php
require_once "../../database/funcBanco.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idUsuario = $_GET["id"];
    $usuario = buscarUsuarioPorID($idUsuario);

    if ($usuario) {
        echo "<h2>Editar Usuário</h2>";
        echo "<form action='atualizarUsuario.php' method='POST'>";
        echo "<input type='hidden' name='idUsuario' value='".$usuario['id_usuario']."'>";
        echo "<label for='nome'>Nome:</label>";
        echo "<input type='text' name='nome' value='".$usuario['nome_usuario']."'>";
        echo "<label for='email'>E-mail:</label>";
        echo "<input type='email' name='email' value='".$usuario['email_usuario']."'>";
        echo "<input type='submit' value='Atualizar'>";
        echo "</form>";
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
