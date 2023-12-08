<?php
session_start();
include("./conecta.php");

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $conn->real_escape_string($_POST['login']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql = "SELECT * FROM USUUsuario WHERE USUEmail = '$login' AND USUSenha = '$senha'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Erro SQL: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['IDCodigo'] = $row['USUCodigo']; 
        header("Location: ./cadastro/tarefas_cadastrar.php");
        exit;
    } else {
        header("Location: ../index.php?erro=1");
        exit;
    }
}

$conn->close();
?>
