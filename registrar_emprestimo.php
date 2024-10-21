<?php
// Inclui as classes necessárias
include_once 'Database.php';
include_once 'Emprestimo.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um novo objeto Emprestimo
    $emprestimo = new Emprestimo($db);
    
    // Define os valores para o empréstimo a partir dos dados do formulário
    $emprestimo->livro_id = (int) $_POST['livro_id'];
    $emprestimo->leitor_id = (int) $_POST['leitor_id'];
    $emprestimo->data_emprestimo = $_POST['data_emprestimo'];
    $emprestimo->data_devolucao = $_POST['data_devolucao'];

    // Tenta registrar o empréstimo
    if ($emprestimo->registrarEmprestimo()) {
        echo "Empréstimo registrado com sucesso!";
    } else {
        echo "Erro ao registrar empréstimo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empréstimo</title>
</head>
<body>
    <h1>Registrar Empréstimo</h1>
    <form action="registrar_emprestimo.php" method="post">
        <label for="livro_id">ID do Livro:</label>
        <input type="number" name="livro_id" id="livro_id" required><br><br>

        <label for="leitor_id">ID do Leitor:</label>
        <input type="number" name="leitor_id" id="leitor_id" required><br><br>

        <label for="data_emprestimo">Data de Empréstimo:</label>
        <input type="date" name="data_emprestimo" id="data_emprestimo" required><br><br>

        <label for="data_devolucao">Data de Devolução:</label>
        <input type="date" name="data_devolucao" id="data_devolucao" required><br><br>

        <input type="submit" value="Registrar Empréstimo">
    </form>
</body>
</html>
