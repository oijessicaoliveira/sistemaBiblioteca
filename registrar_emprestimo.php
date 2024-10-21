<?php
// Inclui a classe Database para conexão com o banco de dados
include_once 'Database.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Verifica se o formulário foi enviado via POST
    $livro_id = (int) $_POST['livro_id'];  // Converte o ID do livro para inteiro
    $leitor_id = (int) $_POST['leitor_id'];  // Converte o ID do leitor para inteiro
    $data_emprestimo = $_POST['data_emprestimo'];  // Captura a data de empréstimo
    $data_devolucao = $_POST['data_devolucao'];  // Captura a data de devolução

    // Insere o empréstimo na tabela emprestimos
    $query = "INSERT INTO emprestimos (livro_id, leitor_id, data_emprestimo, data_devolucao) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);  // Prepara a consulta SQL para execução
    $stmt->bind_param("iiss", $livro_id, $leitor_id, $data_emprestimo, $data_devolucao);  // Associa os valores aos parâmetros da consulta (inteiros e strings)

    if ($stmt->execute()) {  // Executa a consulta e verifica se foi bem-sucedida
        // Atualiza a disponibilidade do livro para "não disponível" (0)
        $update_query = "UPDATE livros SET disponibilidade = 0 WHERE id = ?";
        $update_stmt = $db->prepare($update_query);  // Prepara a consulta de atualização
        $update_stmt->bind_param("i", $livro_id);  // Associa o ID do livro ao parâmetro da consulta
        $update_stmt->execute();  // Executa a atualização

        echo "Empréstimo registrado com sucesso!";
    } else {
        echo "Erro ao registrar empréstimo: " . $stmt->error;  // Exibe mensagem de erro em caso de falha
    }

    $stmt->close();  // Fecha o comando SQL
    $db->close();    // Fecha a conexão com o banco de dados
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empréstimo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registrar Empréstimo</h1>  <!-- Cabeçalho da página -->

    <!-- Formulário para registrar empréstimos -->
    <form action="registrar_emprestimo.php" method="post">
        <label for="livro_id">ID do Livro:</label>
        <input type="number" name="livro_id" id="livro_id" required><br><br>  <!-- Campo numérico para o ID do livro -->

        <label for="leitor_id">ID do Leitor:</label>
        <input type="number" name="leitor_id" id="leitor_id" required><br><br>  <!-- Campo numérico para o ID do leitor -->

        <label for="data_emprestimo">Data de Empréstimo:</label>
        <input type="date" name="data_emprestimo" id="data_emprestimo" required><br><br>  <!-- Campo de data para o empréstimo -->

        <label for="data_devolucao">Data de Devolução:</label>
        <input type="date" name="data_devolucao" id="data_devolucao" required><br><br>  <!-- Campo de data para a devolução -->

        <input type="submit" value="Registrar Empréstimo">  <!-- Botão para enviar o formulário -->
    </form>
    <a href="index.php">Voltar à página inicial</a>  <!-- Link para voltar à página inicial -->
</body>
</html>
