<?php
// Inclui a classe Database para conexão com o banco de dados
include_once 'Database.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Verifica se o formulário foi enviado via POST
    $nome = $_POST['nome'];  // Captura o nome do leitor
    $email = $_POST['email'];  // Captura o email do leitor
    $telefone = $_POST['telefone'];  // Captura o telefone do leitor

    // Insere o leitor na tabela leitores
    $query = "INSERT INTO leitores (nome, email, telefone) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);  // Prepara a consulta SQL para execução
    $stmt->bind_param("sss", $nome, $email, $telefone);  // Associa os valores capturados aos parâmetros da consulta (strings)

    if ($stmt->execute()) {  // Executa a consulta e verifica se foi bem-sucedida
        echo "Leitor inserido com sucesso!";
    } else {
        echo "Erro ao inserir leitor: " . $stmt->error;  // Exibe uma mensagem de erro em caso de falha
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
    <title>Inserir Leitor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inserir Leitor</h1>  <!-- Cabeçalho da página -->
    
    <!-- Formulário para inserção de leitores -->
    <form action="inserir_leitor.php" method="post">
        <label for="nome">Nome do Leitor:</label>
        <input type="text" name="nome" id="nome" required><br><br>  <!-- Campo de texto para o nome do leitor -->

        <label for="email">Email do Leitor:</label>
        <input type="email" name="email" id="email" required><br><br>  <!-- Campo de texto para o email do leitor -->

        <label for="telefone">Telefone do Leitor:</label>
        <input type="text" name="telefone" id="telefone" required><br><br>  <!-- Campo de texto para o telefone do leitor -->

        <input type="submit" value="Inserir Leitor">  <!-- Botão para enviar o formulário -->
    </form>
    <a href="index.php">Voltar à página inicial</a>  <!-- Link para voltar à página inicial -->
</body>
</html>
