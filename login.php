<?php
require_once("../backend/config.php"); // ajuste o caminho se necessário
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = md5(trim($_POST["senha"]));

    $stmt = $conexao->prepare("SELECT * FROM `usuarios` WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_object();
        $_SESSION["email"] = $email;
        $_SESSION["senha"] = $row->senha;
        echo "<script>location.href='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Usuário ou senha inválidos!');</script>";
        echo "<script>location.href='index.php';</script>";
        exit;           
    }
    $stmt->close();

}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Acesso do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f4ef;
            color: #000000;
            font-size: small;
        }

        header, .header, .subheader {
            text-align: center;
            margin-bottom: 20px;
            font-size: large;
        }


        h1 {
            background-color: #f5f4ef;
            color: #2c3e50;
            text-align: center;
        }
        p {
            text-align: center;
            font-size: 1.2em;
        }
        textarea {
            width: 50%;
            height: 100px;
            padding: 20px;
            font-size: 1.1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
            margin: 20px auto;
            resize: vertical; /* Permite redimensionar verticalmente */
        }
        button {
            width: 100px;
            height: 40px;
            font-size: 1em;
            background-color: #272727;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px;
        }
        button:hover {
            background-color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }

         form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"],
        input[type="reset"] {
            width: auto;
            padding: 10px 20px;
            background-color: #272727;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #555;
        }
    </style>

</head>

<body>
    <div class="header">
      <h1>Bem vindo de Volta</h1>
    </div>

     <div class="content">

        <form action="login.php" method="POST">
          <label for="email">Email:<input type="email" id="email" name="email" required placeholder="ex:joao324@gmail.com"></label><br>

          <label for="senha">Senha:</label>
          <input type="password" id="senha" name="senha" required><br>

            <br>

          <input type="reset" value="Limpar">
          <input type="submit" value="Cadastrar">
        
      </form>
    </div>
</body>
</html>