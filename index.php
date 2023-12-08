<?php 
include("./99bystes/conecta.php");
if (isset($_GET['erro']) && $_GET['erro'] == 1) {
    echo '<div class="gradient-custom text-center" style="color: white; border: 0; font-size: 25px; border-radius: 0;">Login ou senha incorretos. Tente novamente.</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="Windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../99bytes/css/style.css">
</head>
<body>
<section class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-5 col-xl-5">
                    <div class="card bg-dark text-white" style="border: none; border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h1>Bem-vindo</h1>
                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-3">Insira seu login e senha!</p>
                            <form method="post" action="./99bytes/processa.php">
                                <div class="form-outline form-white mb-2">
                                    <input type="email" name="login" id="typeEmailX" class="form-control form-control-lg" required />
                                    <label class="form-label" for="typeEmailX">Login</label>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <input type="password" name="senha" id="typePasswordX" class="form-control form-control-lg" required/>
                                    <label class="form-label" for="typePasswordX">Senha</label>
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                <p></p>
                            </form>
                            <div class="centered-content">
                                <a href="./99bytes/esqueceu_senha.php" class="text-white-50 fw-bold" style="font-size: 20px;">Esqueceu a senha?</a>
                                <p></p>
                                <a class="text-white-50" href="./99bytes/cadastro/conta_criar.php" style="font-size: 16px;">Criar uma conta</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="background-color: #333; padding: 20px; border-radius: 1rem;">
                <div class="text-white">
                    <h3>Tasker - Sua Aplicação de Gerenciamento de Tarefas</h3>
                    <p>Tasker, é uma solução completa para gerenciamento de tarefas! Esta aplicação web foi projetada para ajudar você a organizar suas tarefas diárias, definir prioridades e prazos de conclusão, tudo em um só lugar. Simplifique sua vida e mantenha-se produtivo com o Tasker.</p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
