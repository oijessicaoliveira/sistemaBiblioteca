<?php
// Inclui a classe Database para conexão com o banco de dados
include_once 'Database.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Verifica se o formulário foi enviado via POST
    $titulo = $_POST['titulo'];  // Captura o título do livro
    $autor_id = (int) $_POST['autor_id'];  // Converte o ID do autor para número inteiro
    $ano_publicacao = (int) $_POST['ano_publicacao'];  // Converte o ano de publicação para número inteiro
    $disponibilidade = (int) $_POST['disponibilidade'];  // Converte a disponibilidade para número inteiro (1 ou 0)

    // Insere o livro na tabela livros
    $query = "INSERT INTO livros (titulo, autor_id, ano_publicacao, disponibilidade) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);  // Prepara a consulta SQL para execução
    $stmt->bind_param("siii", $titulo, $autor_id, $ano_publicacao, $disponibilidade);  // Associa os parâmetros da consulta (string e inteiros)

    if ($stmt->execute()) {  // Executa a consulta e verifica se foi bem-sucedida
        echo "Livro inserido com sucesso!";
    } else {
        echo "Erro ao inserir livro: " . $stmt->error;
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
    <title>Inserir Livro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inserir Livro</h1>  <!-- Cabeçalho da página -->
    
    <!-- Formulário para inserção de livros -->
    <form action="inserir_livro.php" method="post">
        <label for="titulo">Título do Livro:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>  <!-- Campo de texto para o título do livro -->

        <label for="autor_id">ID do Autor:</label>
        <input type="number" name="autor_id" id="autor_id" required><br><br>  <!-- Campo numérico para o ID do autor -->

        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" name="ano_publicacao" id="ano_publicacao" required><br><br>  <!-- Campo numérico para o ano de publicação -->

        <label for="disponibilidade">Disponível:</label>
        <select name="disponibilidade" id="disponibilidade">  <!-- Menu suspenso para selecionar se o livro está disponível -->
            <option value="1">Sim</option>  <!-- Opção Sim para indicar que o livro está disponível -->
            <option value="0">Não</option>  <!-- Opção Não para indicar que o livro não está disponível -->
        </select><br><br>

        <input type="submit" value="Inserir Livro">  <!-- Botão para enviar o formulário -->
    </form>
    <a href="index.php">Voltar à página inicial</a>  <!-- Link para voltar à página inicial -->
</body>
</html>
