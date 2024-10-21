<?php
class Emprestimo {
    private $conn;
    private $table_name = "emprestimos";

    public $id;  // ID do empréstimo (corresponde à coluna id)
    public $livro_id;  // ID do livro (referência à tabela livros)
    public $leitor_id;  // ID do leitor (referência à tabela leitores)
    public $data_emprestimo;  // Data do empréstimo
    public $data_devolucao;  // Data de devolução

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar um empréstimo no banco de dados
    public function registrarEmprestimo() {
        $query = "INSERT INTO " . $this->table_name . " (livro_id, leitor_id, data_emprestimo, data_devolucao) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiss", $this->livro_id, $this->leitor_id, $this->data_emprestimo, $this->data_devolucao);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
