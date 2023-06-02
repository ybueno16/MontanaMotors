<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/Login/login.css">
    <title>Login</title>
</head>

<body>
    <div class="main-login">
        <form action="" method="POST" class="card-login">
            <h1>Login</h1>
            <div class="textfield">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" placeholder="Usuário">
            </div>
            <div class="textfield">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Senha">
            </div>
            <button class="btn-login" type="submit">Login</button>
            <button class="btn-cadastro"><a href="/pages/cadastro.php">Realize seu cadastro</a></button>
        </form>

        <?php
        require_once "database/funcBanco.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["usuario"]) && isset($_POST["senha"])) {
                $usuario = $_POST["usuario"];
                $senha = $_POST["senha"];
        
                if (verificarLogin($conexao)) {
                    header("Location: /pages/Home/dashboard.php");
                    exit();
                } else {
                    echo "<script>
                            var popup = document.createElement('div');
                            popup.className = 'popup';
                            popup.innerHTML = '<p>Usuário ou senha incorretos. Tente novamente.</p><button onclick=\"fecharPopup()\">Fechar</button>';
                            document.body.appendChild(popup);

                            function fecharPopup() {
                                document.body.removeChild(popup);
                            }
                        </script>";
                }
            } else {
                echo "<script>
                        var popup = document.createElement('div');
                        popup.className = 'popup';
                        popup.innerHTML = '<p>Informe usuário e senha.</p><button onclick=\"fecharPopup()\">Fechar</button>';
                        document.body.appendChild(popup);

                        function fecharPopup() {
                            document.body.removeChild(popup);
                        }
                    </script>";
            }
        }
        ?>
    </div>

</body>

</html>