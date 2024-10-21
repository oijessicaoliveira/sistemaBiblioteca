<?php
class Livro {                         // Define a classe Livro, responsável por interagir com a tabela de livros no banco de dados.
    private $conn;                    // Atributo privado para armazenar a conexão com o banco de dados.
    private $table_name = "livros";   // Nome da tabela no banco de dados que a classe irá manipular (neste caso, "livros").

    public $id;                       // Atributo público que armazenará o ID do livro.
    public $titulo;                   // Atributo público para armazenar o título do livro.
    public $autor_id;                 // Atributo público para armazenar o ID do autor do livro.
    public $ano_publicacao;           // Atributo público para armazenar o ano de publicação do livro.
    public $disponibilidade;          // Atributo público para armazenar a disponibilidade do livro (1 = disponível, 0 = não disponível).

    // Construtor da classe, recebe a conexão com o banco de dados e a armazena no atributo $conn.
    public function __construct($db) {
        $this->conn = $db;            // Atribui a conexão passada como argumento ao atributo $conn.
    }

    // Método para inserir um novo livro no banco de dados.
    public function inserirLivro() {
        $query = "INSERT INTO " . $this->table_name . " (titulo, autor_id, ano_publicacao, disponibilidade) 
                  VALUES (?, ?, ?, ?)";  // SQL para inserir um novo livro, com parâmetros para os dados do livro.
        $stmt = $this->conn->prepare($query);  // Prepara a query para execução.
        $stmt->bind_param("siii", $this->titulo, $this->autor_id, $this->ano_publicacao, $this->disponibilidade);
        // Associa os valores (título, autor_id, ano de publicação, disponibilidade) aos parâmetros da query.
        
        // Executa a query e retorna true se bem-sucedida, ou false em caso de erro.
        if ($stmt->execute()) {
            return true;               // Retorna true se o livro foi inserido com sucesso.
        }
        return false;                  // Retorna false se houve erro na inserção.
    }
}
?>
