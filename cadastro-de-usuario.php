<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuário</title>
</head>

<body>
  <h1>Cadastro de Usuário</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required><br>
    <label for="confirmar_senha">Confirmar Senha:</label>
    <input type="password" name="confirmar_senha" id="confirmar_senha" required><br>
    <input type="reset" value="Limpar" name="limpar">
    <input type="submit" value="Enviar" name="enviar">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmar_senha'])) {
          echo "Por favor, preencha todos os campos.";
          exit;
  }

      if ($_POST['senha'] !== $_POST['confirmar_senha']) {
          echo "As senhas não coincidem.";
          exit;
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $email = test_input($_POST["email"]);
          $senha = test_input($_POST["senha"]);
          $confirmar_senha = test_input($_POST["confirmar_senha"]);
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "Formato de email inválido.";
          exit;
      }

      
  }

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }




  $emails = ['email1@example.com', 'email2@example.com', 'email3@example.com'];
  $senhas = ['senha1', 'senha2', 'senha3'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $novo_email = $_POST['email'];
      $nova_senha = $_POST['senha'];
      // $confirmar_senha = $_POST['confirmar_senha']; // já validado acima

      if (in_array($novo_email, $emails)) {
        echo "O email $novo_email já está cadastrado.";
      } else {
        $emails[] = $novo_email;
        $senhas[] = $nova_senha;
        echo "O email $novo_email foi cadastrado com sucesso.";
      }
    }

  echo "<h2>Usando var_dump</h2>";
  var_dump($emails);
  var_dump($senhas);

  echo "<h2>Usando print_r</h2>";
  print_r($emails);
  print_r($senhas);

  echo "<h2>Usando foreach</h2>";
  foreach ($emails as $e) {
    echo "Email: $e <br>";
  }
  foreach ($senhas as $s) {
    echo "Senha: $s <br>";
  }



  ?>
</body>

</html>







