<?php
class Leitor {
    private $conn;
    private $table_name = "leitores";

    public $id;  // ID do leitor (corresponde à coluna id)
    public $nome;  // Nome do leitor
    public $email;  // Email do leitor
    public $telefone;  // Telefone do leitor

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para inserir um leitor no banco de dados
    public function inserirLeitor() {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->nome, $this->email, $this->telefone);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
