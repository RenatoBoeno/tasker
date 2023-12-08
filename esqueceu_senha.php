<?php
include("./conecta.php");
session_start();

if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailUsuario = $_POST['email'];

    $consulta = "SELECT USUSenha FROM USUUsuario WHERE USUEmail = '$emailUsuario'";
    $resultado = mysqli_query($conn, $consulta);

    if ($resultado) {
        if (mysqli_num_rows($resultado) == 1) {
            $linha = mysqli_fetch_assoc($resultado);
            $senhaUsuario = $linha['USUSenha'];

            $assunto = "Recuperação de Senha";
            $mensagem = "Sua senha é: " . $senhaUsuario;
            $headers = "From: seu-email@dominio.com";

            mail($emailUsuario, $assunto, $mensagem, $headers);

            $mensagem = "A senha foi enviada para o seu e-mail.";

            echo '<div class="gradient-custom text-center" style="color: white; border: 0; font-size: 25px; border-radius: 0;">E-mail recuperado com sucesso! Voce sera redirecionado em breve...</div>';
            echo '<script>
                setTimeout(function() {
                    window.location.href = "../index.php";
                }, 3000); // Redireciona apos 3 segundos (3000 milissegundos)
            </script>';
        } else {
            $mensagem = "E-mail não encontrado no sistema.";
            $_SESSION['mensagem'] = $mensagem;
        }
    } else {
        $mensagem = "Erro ao consultar o banco de dados: " . mysqli_error($conn);
        $_SESSION['mensagem'] = $mensagem;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-5 col-xl-5">
                    <div class="card bg-dark text-white" style="border: none; border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <?php
                            if (isset($_SESSION['mensagem'])) {
                                echo '<div class="alert alert-success" role="alert">';
                                echo $_SESSION['mensagem'];
                                unset($_SESSION['mensagem']);
                            }
                            ?>
                            <h2 class="fw-bold mb-2 text-uppercase">Esqueceu a Senha</h2>
                            <p class="text-white-50 mb-3">Insira seu e-mail para receber a sua senha.</p>
                            <form method="post" action="">
                                <div class="form-outline form-white mb-2">
                                    <label for="email" class="form-label">E-mail:</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" required>
                                </div>
                                <button type="submit" class="btn btn-outline-light btn-lg px-5">Enviar</button>
                                <div>
                                    <p></p>
                                    <a href="../../index.php" class="text-white-50 fw-bold">Voltar para a tela de login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
