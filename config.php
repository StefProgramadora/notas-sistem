<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'formulario-de-notas';

$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

// if ($conexao->connect_error) {
//    die("Falha na conexão: " . $conexao->connect_error);
// }
// else {
//    echo "Conexão bem-sucedida!";
//}
?>
