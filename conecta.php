<?php
$hostname = "127.0.0.1";  // Substitua pelo seu hostname
$database = "Tasker";   // Substitua pelo nome do seu banco de dados
$username = "renatob";  // Substitua pelo seu nome de usuário
$password = "r1e2n3a4@@##"; // Substitua pela sua senh

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    echo 'erro';
    die("Erro na conexão: " . $conn->connect_error);

}
?>
