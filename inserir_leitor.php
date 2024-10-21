<?php
// Inclui as classes necessárias
include_once 'Database.php';
include_once 'Leitor.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um novo objeto Leitor
    $leitor = new Leitor($db);
    
    // Define os valores para o leitor a partir dos dados do formulário
    $leitor->nome = $_POST['nome'];
    $leitor->email = $_POST['email'];
    $leitor->telefone = $_POST['telefone'];

    // Tenta inserir o leitor usando o método da classe
    if ($leitor->inserirLeitor()) {
        echo "Leitor inserido com sucesso!";
    } else {
        echo "Erro ao inserir leitor.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Leitor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inserir Leitor</h1>
    <!-- Formulário para inserir leitores -->
    <form action="inserir_leitor.php" method="post">
        <label for="nome">Nome do Leitor:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="email">Email do Leitor:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="telefone">Telefone do Leitor:</label>
        <input type="text" name="telefone" id="telefone" required><br><br>

        <input type="submit" value="Inserir Leitor">
    </form>
    <a href="index.php">Voltar à página inicial</a>
</body>
</html>
