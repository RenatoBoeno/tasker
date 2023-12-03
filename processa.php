<?php
session_start();
include './conecta.php';
$login = $_POST['login'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM USUUsuario WHERE USUEmail = '$login' AND USUSenha = '$senha'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['IDCodigo'] = $row['USUCodigo']; 
    header("Location: ouahsfhdasdeasea");
} else {
    header("Location: dodspfsadf23nrjlsa?erro=1");
}
$conn->close();
?>
