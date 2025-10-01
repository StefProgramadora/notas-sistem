<?php
// Conexão com o banco de dados
require "comum.php"; //

// Inicia sessões
session_start(); //

// Recupera o login e a senha, criptografando a senha em MD5
$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE; //
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE; //

// Usuário não forneceu a senha ou o email
if(!$email || !$senha) { //
    echo "Você deve digitar sua senha e email!"; //
    exit;
}

/**
 * Executa a consulta no banco de dados para verificar as credenciais.
 * Caso o número de linhas retornadas seja 1, o email é válido, caso 0, inválido.
 */
$mysqli = "SELECT email, senha, postar FROM aut_usuarios WHERE email = '" . $email . "'"; //
$result_id = @mysqli_query($mysqli, $mysqli) or die("Erro no banco de dados!"); //
$total = @mysqli_num_rows($result_id); //

// Caso o usuário tenha digitado um email válido, o número de linhas será 1
if($total) { //
    // Obtém os dados do usuário para verificar a senha e passar os demais dados para a sessão
    $dados = @mysqli_fetch_array($result_id); //

    // Agora verifica a senha (comparando as senhas já criptografadas em MD5)
    if(!strcmp($senha, $dados["senha"])) { //
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
        $_SESSION["id"] = $dados["id"]; //
        $_SESSION["nome_usuario"] = stripslashes($dados["nome"]); //
        $_SESSION["permissao"] = $dados["postar"]; //
        header("Location: index.php"); // // Redireciona para a página principal (restrita)
        exit;
    }
    // Senha inválida
    else { //
        echo "Senha inválida!"; //
        exit;
    }
}
// Login inválido
else { //
    echo "O login fornecido por você é inexistente!"; //
    exit;
}
?>