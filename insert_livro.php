<?php
// Inclui as classes necessárias para o sistema funcionar.
include_once 'Database.php';   // Inclui a classe Database para estabelecer a conexão com o banco de dados.
include_once 'Autor.php';      // Inclui a classe Autor para manipular a tabela de autores.
include_once 'Livro.php';      // Inclui a classe Livro para manipular a tabela de livros.

// Cria a conexão com o banco de dados.
$database = new Database();    // Cria uma nova instância da classe Database.
$db = $database->getConnection();  // Chama o método getConnection() para obter a conexão com o banco de dados e armazena na variável $db.

// Verifica se o formulário foi enviado através do método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Verifica se a página foi acessada via POST (ou seja, se o formulário foi enviado).

    // Instancia as classes Livro e Autor para realizar operações.
    $livro = new Livro($db);   // Cria uma nova instância da classe Livro, passando a conexão $db.
    $autor = new Autor($db);   // Cria uma nova instância da classe Autor, passando a conexão $db.

    // Pega os dados enviados pelo formulário e atribui aos atributos da classe Livro e Autor.
    $livro->titulo = $_POST['titulo'];          // Atribui o valor do campo "titulo" do formulário ao atributo $titulo do objeto $livro.
    $autor->nome = $_POST['autor'];             // Atribui o valor do campo "autor" ao atributo $nome do objeto $autor.
    $livro->ano_publicacao = (int) $_POST['ano_publicacao'];  // Converte o valor do campo "ano_publicacao" para inteiro e atribui ao objeto $livro.
    $livro->disponibilidade = (int) $_POST['disponibilidade'];  // Converte o valor do campo "disponibilidade" para inteiro e atribui ao objeto $livro.

    // Verifica se o autor já existe no banco de dados.
    if (!$autor->verificarAutor()) {  // Se o autor não existir (retorno false do método verificarAutor()):
        // Insere um novo autor se ele não for encontrado.
        if (!$autor->inserirAutor()) {  // Se houver erro ao inserir o autor:
            echo "Erro ao inserir autor.";  // Exibe uma mensagem de erro.
            exit();  // Encerra a execução do script para não tentar inserir o livro com erro.
        }
    }

    // Atribui o ID do autor ao atributo $autor_id do livro.
    $livro->autor_id = $autor->id;  // O ID do autor recém-inserido (ou já existente) é atribuído ao livro.

    // Insere o livro no banco de dados.
    if ($livro->inserirLivro()) {  // Se o livro for inserido com sucesso:
        echo "Livro cadastrado com sucesso!";  // Exibe uma mensagem de sucesso.
    } else {
        echo "Erro ao cadastrar livro.";  // Se houver erro ao cadastrar o livro, exibe uma mensagem de erro.
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">  <!-- Define o charset para UTF-8, permitindo o uso de caracteres especiais. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Configura a visualização para dispositivos móveis. -->
    <link rel="stylesheet" href="style.css"> <!-- Link para o CSS externo -->
    <title>Cadastro de Livros</title>  <!-- Define o título da página. -->
</head>
<body>
    <h1>Inserir Livro na Biblioteca</h1>  <!-- Título principal da página. -->

    <!-- Formulário para inserção de livros. -->
    <form action="insert_livro.php" method="post">  <!-- O formulário envia os dados para a própria página usando o método POST. -->
        <label for="titulo">Título:</label>  <!-- Rótulo para o campo de título. -->
        <input type="text" name="titulo" id="titulo" required><br><br>  <!-- Campo de texto para o título do livro, obrigatório. -->

        <label for="autor">Autor:</label>  <!-- Rótulo para o campo de autor. -->
        <input type="text" name="autor" id="autor" required><br><br>  <!-- Campo de texto para o nome do autor, obrigatório. -->

        <label for="ano_publicacao">Ano de Publicação:</label>  <!-- Rótulo para o campo de ano de publicação. -->
        <input type="number" name="ano_publicacao" id="ano_publicacao" required><br><br>  <!-- Campo numérico para o ano de publicação, obrigatório. -->

        <label for="disponibilidade">Disponível:</label>  <!-- Rótulo para o campo de disponibilidade. -->
        <select name="disponibilidade" id="disponibilidade">  <!-- Menu suspenso para selecionar a disponibilidade do livro. -->
            <option value="1">Sim</option>  <!-- Opção "Sim", indicando que o livro está disponível. -->
            <option value="0">Não</option>  <!-- Opção "Não", indicando que o livro não está disponível. -->
        </select><br><br>

        <input type="submit" value="Cadastrar Livro">  <!-- Botão para enviar o formulário. -->
    </form>
</body>
</html>
