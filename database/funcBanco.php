<?php
require_once "connBanco.php";
$conexao = connBanco();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"]) && $_POST["login"] == "verificarLogin") {
        verificarLogin($conexao);
    } elseif (isset($_POST["acao"]) && $_POST["acao"] == "cadastroUsuario") {
        die;
    }
}

function verificarLogin($conexao)
{
    if (isset($_POST["usuario"]) && isset($_POST["senha"])) {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        $query = "SELECT * FROM usuario WHERE nome_usuario = '$usuario' AND senha_usuario = '$senha'";
        $resultado = $conexao->query($query);

        if ($resultado && $resultado->num_rows > 0) {
            header("Location: /pages/Home/dashboard.html");
            exit();
        } else {
            echo "<script>window.location.href='/index.php?erro=1';</script>";
            exit();
        }
    } else {
        echo "<script>window.location.href='/index.php?erro=1';</script>";
        exit();
    }
}


function cadastroUsuario($nome, $email, $senha)
{
    global $conexao;

    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);
    $senha = mysqli_real_escape_string($conexao, $senha);

    $query = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) VALUES ('$nome', '$email', '$senha')";

    if ($conexao->query($query) === TRUE) {
        echo "Valores inseridos com sucesso!";
    } else {
        echo "Erro na inserção: " . $conexao->error;
    }
}

function buscarID($email)
{
    global $conexao;
    $email = mysqli_real_escape_string($conexao, $email);

    $query = "SELECT id_usuario FROM usuario WHERE email_usuario = '$email'";
    $resultado = $conexao->query($query);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        return $row['id_usuario'];
    } else {
        return false;
    }
}



function atualizarUsuario($email, $nome, $senha)
{
    global $conexao;

    $nome = mysqli_real_escape_string($conexao, $nome);
    $senha = mysqli_real_escape_string($conexao, $senha);
    $email = mysqli_real_escape_string($conexao, $email);

    $id = buscarID($email);

    if ($id === true) {
        $query = "UPDATE nome_usuario SET nome_usuario = '$nome', senha_usuario = '$senha' WHERE id_usuario = $id";

        if ($conexao->query($query) === TRUE) {
            echo "Registro atualizado com sucesso!";
        } else {
            echo "Erro na atualização: " . $conexao->error;
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>