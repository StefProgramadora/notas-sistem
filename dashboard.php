 
<!DOCTYPE html>

<?php
$cookie_name = "titulo";
$cookie_value = "titulo";
$cookie_name2 = "conteudo";
$cookie_value2 = "conteudo";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
?>


<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página</title>
</head>
<body>
    <style>

        header, .header, .subheader {
            text-align: center;
            margin-bottom: 20px;
            font-size: large;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f4;
            color: #000000;
        }

        h1 {
            background-color: #000    000;
            color: #ffffff;
            text-align: center;
        }

        content {
            background-color: #ffffff;
            text-align: center;
            margin-top: 20px;
            font-size: small;
            color: #777;
        }

        footer, .footer {
            text-align: center;
            margin-top: 20px;
            font-size: small;
            color: #777;
        }

    </style>

    <div class="header">
    <h1>Note In</h1>
    </div>

    <div class="content">
        <h2>Dashboard</h2>
        <p>Últimas Notas</p>

    <section id="adicionar" class="card">
                <h2>Adicionar Nota</h2>
                <form id="formNota">
                    <div style="margin-bottom: 1rem;">
                        <label for="titulo">Título:</label><br>
                        <input type="text" id="titulo" name="titulo" required style="width: 100%; padding: 8px; margin-top: 5px;">
                    </div>
                                        
                    <div style="margin-bottom: 1rem;">
                        <label for="conteudo">Conteúdo:</label><br>
                        <textarea id="conteudo" name="conteudo" rows="5" required style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Salvar Nota</button>
                    <button type="reset" class="btn2">Limpar Nota</button>
                </form>
            </section>

    </div>

    <div class="footer">
      <p style="text-align:center">Note It™ 2025 - Todos os direitos reservados</p>
    </div>

    <div class="footer">
        <p>&copy; 2025 Note In. Todos os direitos reservados.</p>
    </div>

   

<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
  echo "Cookie named '" . $cookie_name . "' is not set!";
  
} else {
  echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html>
