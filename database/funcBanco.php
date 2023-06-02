<?php
require_once "connBanco.php";
$conexao = connBanco();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"]) && $_POST["login"] == "verificarLogin") {
        verificarLogin($conexao);
    } elseif (isset($_POST["acao"]) && $_POST["acao"] == "cadastroUsuario") {
        $nome = $_POST["usuario"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        cadastroUsuario($nome, $email, $senha);
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
            header("Location: /pages/Home/dashboard.php");
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

    $query = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($query);
    if ($stmt) {
        $stmt->bind_param("sss", $nome, $email, $senha);
        $resultado = $stmt->execute();

        if ($resultado) {
            echo "Valores inseridos com sucesso!";
        } else {
            echo "Erro na inserção: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da declaração: " . $conexao->error;
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



function listarUsuarios()
{
    global $conexao;

    $query = "SELECT * FROM usuario";
    $result = $conexao->query($query);

    if ($result->num_rows > 0) {
        $usuarios = array();
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        return $usuarios;
    } else {
        return array();
    }
}

function excluirUsuario($idUsuario)
{
    global $conexao;

    $query = "DELETE FROM usuario WHERE id_usuario = ?";
    $stmt = $conexao->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $idUsuario);
        $resultado = $stmt->execute();

        if ($resultado) {
            echo "Usuário excluído com sucesso!";
        } else {
            echo "Erro na exclusão: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da declaração: " . $conexao->error;
    }
}


function buscarUsuarioPorID($idUsuario) {
    $conexao = connBanco();
    
    $query = "SELECT * FROM usuario WHERE id_usuario = $idUsuario";
    $resultado = mysqli_query($conexao, $query);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado);
        desconectar($conexao);
        return $usuario;
    } else {
        desconectar($conexao);
        return null;
    }
}
  
  
function atualizarUsuario($idUsuario, $nome, $email) {
    $conexao = connBanco();
    $query = "UPDATE usuario SET nome_usuario = '$nome', email_usuario = '$email' WHERE id_usuario = '$idUsuario'";
    $resultado = mysqli_query($conexao, $query);

    desconectar($conexao);

    if ($resultado) {
        return true;
    } else {
        return false;
    }
}


  
  