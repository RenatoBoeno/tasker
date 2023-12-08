<?php
session_start();

if (!isset($_SESSION['IDCodigo'])) {
    header("Location: ./index.php?erro=1");
    exit;
}

include '../conecta.php';
$IDCodigo = $_SESSION['IDCodigo'];
$dataAtual = date("Y-m-d");

if (isset($_POST['taskText']) && isset($_POST['taskPriority']) && isset($_POST['taskDate'])) {
    $sqlIncluirTarefas = "INSERT INTO TARTarefas (TARTarefa, TARPrioridade, TARData, TARConcluida, USUCodigo) VALUES ('" . $_POST['taskText'] . "', '" . $_POST['taskPriority'] . "', '" . $_POST['taskDate'] . "', 'Não', '" .$IDCodigo. "' )";
    $resIncluirTarefas = $conn->query($sqlIncluirTarefas);

    header("Location: ./tarefas_cadastrar.php");
}

$sqlAtualizarAtrasadas = "UPDATE TARTarefas SET TARConcluida = 'Atrasada' WHERE USUCodigo = '$IDCodigo' AND TARConcluida = 'Não' AND TARData < '$dataAtual'";
$resAtualizarAtrasadas = $conn->query($sqlAtualizarAtrasadas);

if (isset($_POST['concluir']) && isset($_POST['tarefa_id'])) {
    foreach ($_POST['tarefa_id'] as $tarefa_id) {
        $sqlConcluirTarefa = "UPDATE TARTarefas SET TARConcluida = 'Sim' WHERE TARCodigo = '$tarefa_id'";
        $conn->query($sqlConcluirTarefa);
    }
    header("Location: ./tarefas_cadastrar.php"); 
}

$sqlListarTarefas = "SELECT TARCodigo, TARTarefa, TARPrioridade, TARConcluida, DATE_FORMAT(TARData, '%d/%m/%y') as formattedDate FROM TARTarefas WHERE USUCodigo = '$IDCodigo' AND (TARConcluida = 'Não' OR TARConcluida = 'Atrasada')";
$resListarTarefas = $conn->query($sqlListarTarefas);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-3 text-center">
                            <div class="mb-3 mt-md-4 pb-3">
                                <h2 class="text-white fw-bold mb-2 text-uppercase">Minhas Tarefas</h2>
                                <form class="task-form" id="taskForm" method="POST">
                                    <input type="text" id="taskInput" name="taskText" placeholder="Adicionar nova tarefa" required class="form-control">
                                    <div class="form-group">
                                        <label for="taskDate" class="text-white">Data para realizar a tarefa</label>
                                        <input type="date" name="taskDate" id="taskDate" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for "taskPriority" class="text-white">Selecione a prioridade</label>
                                        <select name="taskPriority" id="taskPriority" required class="form-control">
                                            <option value="Alta">Alta</option>
                                            <option value="Média">Média</option>
                                            <option value="Baixa">Baixa</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-3" type="submit">Adicionar</button>
                                </form>
                                
                                <form method="post" action="">
                                    <button type="submit" class="btn btn-danger btn-lg px-3 mt-3" name="logout">Sair</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 task-container text-center">
                    <h3 class="text-white">Tarefas Adicionadas</h3>
                    <form id="form_concluir" method="POST">
                        <ul class="list-group" id="taskList">
                            <?php
                            while ($row = $resListarTarefas->fetch_assoc()) {
                                $priority_class = ''; 

                                switch ($row["TARPrioridade"]) {
                                    case 'Alta':
                                        $priority_class = 'list-group-item-danger';
                                        break;
                                    case 'Média':
                                        $priority_class = 'list-group-item-warning';
                                        break;
                                    case 'Baixa':
                                        $priority_class = 'list-group-item-low';
                                        break;
                                }
                                $atrasada_icon = ($row["TARConcluida"] === 'Atrasada') ? '<i class="fas fa-exclamation-triangle text-warning"></i>' : '';

                                echo '<li class="list-group-item ' . $priority_class . '">';
                                echo '<strong>Tarefa:</strong> ' . $row["TARTarefa"] . ' ' . $atrasada_icon . '<br>';
                                echo '<strong>Prioridade:</strong> ' . $row["TARPrioridade"] . '<br>';
                                echo '<strong>Prazo de Entrega:</strong> ' . $row["formattedDate"] . '<br>';
                                echo '<input type="checkbox" name="tarefa_id[]" value="' . $row["TARCodigo"] . '">';
                                if ($row["TARConcluida"] === 'Atrasada') {
                                    echo '<span class="badge badge-warning">Atrasada</span>';
                                }
                                echo '</li>';
                            }
                            ?>
                        </ul>
                        <button type="submit" class="btn btn-success" name="concluir" form="form_concluir">Concluir</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
    if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }
    $conn->close();
    ?>
</body>
</html>
