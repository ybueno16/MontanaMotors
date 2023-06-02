<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/style/Home/dashboard.css" />
  <link href="https://unpkg.com/css.gg@2.0.0/icons/css/search.css" rel="stylesheet" />
  <title>dashboard</title>
</head>
<body>
  <div class="App">
    <aside class="menu-lateral">
      <div class="image-logo">
        <img src="/Images/logo montana.jpg" alt="" />
      </div>

      <div class="content-itens-menu">
        <a href="/pages/Home/dashboard.html">Home</a>
        <a href="/pages/Home/Estoque/dashboardEstoque.html">Estoque</a>
      </div>

      <div class="sair">
        <a href="/index.php">Sair</a>
      </div>
    </aside>

    <div class="main-dashboard">
      <h1>Consulta Usuários</h1>
      <header class="search-header">
        <input type="text" placeholder="Pesquise aqui" />
      </header>

      <section class="main-table">
        <table>
          <thead>
            <tr>
              <th>Usuário</th>
              <th>E-mail</th>
              <th colspan="3">Comandos</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require_once "../../database/funcBanco.php";
              $usuarios = listarUsuarios();

              foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>".$usuario['nome_usuario']."</td>";
                echo "<td>".$usuario['email_usuario']."</td>";
                echo "<td><button onclick=\"editarUsuario('".$usuario['id_usuario']."')\">Editar</button></td>";
                echo "<td><button onclick=\"excluirUsuario('".$usuario['id_usuario']."')\">Excluir</button></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </section>
    </div>
  </div>

  <!-- Inclua a biblioteca jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function editarUsuario(idUsuario) {
      // Redireciona para a página de edição do usuário, passando o ID como parâmetro
      window.location.href = "editarUsuario.php?id=" + idUsuario;
    }

    function excluirUsuario(idUsuario) {
      if (confirm("Deseja excluir o usuário?")) {
        $.ajax({
          url: "excluirUsuario.php",
          type: "POST",
          data: { idUsuario: idUsuario },
          success: function(response) {
            alert(response);
            location.reload();
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    }
  </script>
</body>
</html>
