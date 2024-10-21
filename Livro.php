<?php
class Livro {
    private $conn;
    private $table_name = "livros";

    public $id;  // ID do livro (corresponde à coluna id)
    public $titulo;  // Título do livro
    public $autor_id;  // ID do autor (referência à tabela autores)
    public $ano_publicacao;  // Ano de publicação
    public $disponibilidade;  // Disponibilidade do livro (1 = disponível, 0 = indisponível)

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para inserir um livro no banco de dados
    public function inserirLivro() {
        $query = "INSERT INTO " . $this->table_name . " (titulo, autor_id, ano_publicacao, disponibilidade) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("siii", $this->titulo, $this->autor_id, $this->ano_publicacao, $this->disponibilidade);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
