<?php
// Inclui as classes necessárias
include_once 'Database.php';
include_once 'Livro.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um novo objeto Livro
    $livro = new Livro($db);
    
    // Define os valores para o livro a partir dos dados do formulário
    $livro->titulo = $_POST['titulo'];
    $livro->autor_id = (int) $_POST['autor_id'];
    $livro->ano_publicacao = (int) $_POST['ano_publicacao'];
    $livro->disponibilidade = (int) $_POST['disponibilidade'];

    // Tenta inserir o livro usando o método da classe
    if ($livro->inserirLivro()) {
        echo "Livro inserido com sucesso!";
    } else {
        echo "Erro ao inserir livro.";
    }
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
    <h1>Inserir Livro</h1>
    <form action="inserir_livro.php" method="post">
        <label for="titulo">Título do Livro:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="autor_id">ID do Autor:</label>
        <input type="number" name="autor_id" id="autor_id" required><br><br>

        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" name="ano_publicacao" id="ano_publicacao" required><br><br>

        <label for="disponibilidade">Disponível:</label>
        <select name="disponibilidade" id="disponibilidade">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select><br><br>

        <input type="submit" value="Inserir Livro">
    </form>
</body>
</html>
