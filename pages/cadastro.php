<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/Cadastro/cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="main-login">
        <form action="cadastro.php" method="POST" class="card-login">
            <h1>Realize seu cadastro</h1>
            <div class="textfield">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" placeholder="Usuário">
            </div>

            <div class="textfield">
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Digite seu e-mail">
            </div>

            <div class="textfield">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha">
            </div>

            <div class="textfield">
                <label for="conf-senha">Confirme sua senha</label>
                <input type="password" name="conf-senha" placeholder="Digite sua senha">
            </div>

            <button class="btn-login" type="submit" name="cadastro">Salvar</button>

            <?php
            require_once "../database/funcBanco.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastro"])) {
                $nome = $_POST["usuario"];
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                if (!empty($email)) {
                    cadastroUsuario($nome, $email, $senha);
                } else {
                    echo "<script>alert('O campo de e-mail é obrigatório.');</script>"; 
                }               
            }
            ?>
        </form>
    </div>
</body>

</html>