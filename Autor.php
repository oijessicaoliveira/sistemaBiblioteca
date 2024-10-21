<?php
class Autor {                        // Define a classe Autor, responsável por interagir com a tabela de autores no banco de dados.
    private $conn;                   // Atributo privado para armazenar a conexão com o banco de dados, passada para a classe.
    private $table_name = "autores"; // Nome da tabela no banco de dados que a classe irá manipular (neste caso, "autores").

    public $id;                      // Atributo público que armazenará o ID do autor.
    public $nome;                    // Atributo público que armazenará o nome do autor.

    // Construtor da classe, recebe a conexão com o banco de dados e a armazena no atributo $conn.
    public function __construct($db) {
        $this->conn = $db;           // Atribui a conexão passada como argumento ao atributo $conn.
    }

    // Método que verifica se o autor já existe no banco de dados.
    public function verificarAutor() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE nome = ?"; // SQL para verificar se já existe um autor com o nome fornecido.
        $stmt = $this->conn->prepare($query);  // Prepara a query para execução, prevenindo injeção de SQL.
        $stmt->bind_param("s", $this->nome);   // Associa o nome do autor ao parâmetro da query ("s" indica que é uma string).
        $stmt->execute();                      // Executa a query.
        $resultado = $stmt->get_result();      // Armazena o resultado da execução.

        // Se o autor já existir (número de linhas > 0), armazena o ID do autor e retorna true.
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();  // Obtém o resultado da consulta como um array associativo.
            $this->id = $row['id'];            // Armazena o ID do autor encontrado no atributo $id.
            return true;                       // Retorna true, indicando que o autor já existe.
        }

        return false;                          // Retorna false, indicando que o autor não foi encontrado.
    }

    // Método que insere um novo autor no banco de dados.
    public function inserirAutor() {
        $query = "INSERT INTO " . $this->table_name . " (nome) VALUES (?)";  // SQL para inserir um novo autor.
        $stmt = $this->conn->prepare($query);  // Prepara a query para execução.
        $stmt->bind_param("s", $this->nome);   // Associa o nome do autor ao parâmetro da query.

        // Executa a query e verifica se a inserção foi bem-sucedida.
        if ($stmt->execute()) {
            $this->id = $this->conn->insert_id;  // Armazena o ID do autor recém-inserido.
            return true;                         // Retorna true para indicar sucesso.
        }
        return false;                            // Retorna false se houve erro.
    }
}
?>
