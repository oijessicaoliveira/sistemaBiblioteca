<?php
// Inclui as classes necessárias
include_once 'Database.php';
include_once 'Autor.php';

// Cria a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um novo objeto Autor
    $autor = new Autor($db);
    
    // Define os valores para o autor a partir dos dados do formulário
    $autor->nome = $_POST['nome'];
    $autor->nacionalidade = $_POST['nacionalidade'];

    // Tenta inserir o autor usando o método da classe
    if ($autor->inserirAutor()) {
        echo "Autor inserido com sucesso!";
    } else {
        echo "Erro ao inserir autor.";
    }
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
    <h1>Inserir Autor</h1>
    <form action="inserir_autor.php" method="post">
        <label for="nome">Nome do Autor:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="nacionalidade">Nacionalidade:</label>
        <input type="text" name="nacionalidade" id="nacionalidade" required><br><br>

        <input type="submit" value="Inserir Autor">
    </form>
</body>
</html>
