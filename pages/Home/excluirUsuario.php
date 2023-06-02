<?php
require_once "../../database/funcBanco.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idUsuario"])) {
        $idUsuario = $_POST["idUsuario"];
        excluirUsuario($idUsuario);
    }
}
?>
