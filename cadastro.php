<?php
require_once("../backend/config.php"); // ajuste o caminho se necessário

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['email']);
    $senha = test_input($_POST['senha']);
    $confirmar_senha = test_input($_POST['confirmar_senha']);

    if ($senha !== $confirmar_senha) {
        $mensagem = "As senhas não coincidem. Por favor, tente novamente.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "Formato de email inválido.";
    } else {
        // Hash da senha para segurança (recomenda-se password_hash, mas mantendo md5 conforme original)
        $senha_hashed = md5($senha);
        // Verifica se o email já existe
        $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $mensagem = "Este email já está cadastrado.";
        } else {
            $stmt->close();
            $stmt = $conexao->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $senha_hashed);
            if ($stmt->execute()) {
                $mensagem = "Usuário cadastrado com sucesso!";
                echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
                echo "<script>setTimeout(function(){ location.href='index.php'; }, 2000);</script>";
            } else {
                $mensagem = "Erro ao cadastrar usuário: " . $stmt->error;
                echo "<script>alert('Erro ao cadastrar usuário!');</script>";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Usuário</title>
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
            <h1>Bem vindo ao Note In!</h1>
        </div>

        <div class="content">
                <?php if (!empty($mensagem)) { echo '<p style="color: #b00; text-align:center;">' . $mensagem . '</p>'; } ?>
                <form action="cadastro.php" method="POST">
                    <label for="email">Email:<input type="email" id="email" name="email" required placeholder="ex:joao324@gmail.com"></label><br>

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required><br>

                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required><br>

                    <input type="reset" value="Limpar">
                    <input type="submit" value="Cadastrar">
                </form>
        </div>
</body>
</html>