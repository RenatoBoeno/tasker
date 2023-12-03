<?php
$hostname = 'localhost'; 
$database = 'tasker';
$username = 'root';
$password = '';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

?>
