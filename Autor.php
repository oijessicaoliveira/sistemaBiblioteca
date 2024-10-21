<?php
class Autor {
    private $conn;  // Armazena a conexão com o banco de dados
    private $table_name = "autores";  // Nome da tabela no banco de dados

    public $id;  // ID do autor (corresponde à coluna id)
    public $nome;  // Nome do autor (corresponde à coluna nome)
    public $nacionalidade;  // Nacionalidade do autor (corresponde à coluna nacionalidade)

    // O construtor recebe a conexão com o banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para inserir um autor no banco de dados
    public function inserirAutor() {
        $query = "INSERT INTO " . $this->table_name . " (nome, nacionalidade) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->nome, $this->nacionalidade);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
