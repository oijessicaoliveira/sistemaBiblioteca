<?php
// Inclui a classe Database para conexão com o banco de dados
include_once 'Database.php';

// Cria a conexão com o banco de dados
$database = new Database();    // Cria uma nova instância da classe Database
$db = $database->getConnection();  // Chama o método getConnection() para obter a conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Se o formulário foi enviado via método POST, o código será executado
    $nome = $_POST['nome'];  // Captura o valor inserido no campo "nome" do formulário
    $nacionalidade = $_POST['nacionalidade'];  // Captura o valor inserido no campo "nacionalidade" do formulário

    // Insere o autor na tabela autores
    $query = "INSERT INTO autores (nome, nacionalidade) VALUES (?, ?)";  // Define a consulta SQL com parâmetros para evitar injeção de SQL
    $stmt = $db->prepare($query);  // Prepara a consulta SQL para execução
    $stmt->bind_param("ss", $nome, $nacionalidade);  // Associa os valores do formulário aos parâmetros da consulta (2 strings)

    if ($stmt->execute()) {  // Executa a consulta e verifica se foi bem-sucedida
        echo "Autor inserido com sucesso!";  // Exibe uma mensagem de sucesso se o autor foi inserido com sucesso
    } else {
        echo "Erro ao inserir autor: " . $stmt->error;  // Exibe uma mensagem de erro se a inserção falhou
    }

    $stmt->close();  // Fecha o comando SQL para liberar os recursos
    $db->close();    // Fecha a conexão com o banco de dados para economizar recursos
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Autor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inserir Autor</h1>  <!-- Cabeçalho da página -->
    
    <!-- Formulário para inserção de autor -->
    <form action="inserir_autor.php" method="post">  <!-- O formulário envia os dados para a mesma página usando o método POST -->
        <label for="nome">Nome do Autor:</label>
        <input type="text" name="nome" id="nome" required><br><br>  <!-- Campo de texto para o nome do autor, obrigatório -->

        <label for="nacionalidade">Nacionalidade:</label>
        <input type="text" name="nacionalidade" id="nacionalidade" required><br><br>  <!-- Campo de texto para a nacionalidade, obrigatório -->

        <input type="submit" value="Inserir Autor">  <!-- Botão para enviar o formulário -->
    </form>
    <a href="index.php">Voltar à página inicial</a>  <!-- Link para voltar à página inicial -->
</body>
</html>
