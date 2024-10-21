<?php
class Database {                    // Define uma classe chamada Database, responsável pela conexão ao banco de dados.
    private $host = "localhost";    // Atributo privado que armazena o endereço do servidor do banco de dados (geralmente "localhost" para sistemas locais).
    private $db_name = "biblioteca";// Nome do banco de dados a ser conectado (neste caso, "biblioteca").
    private $username = "root";     // Nome de usuário do banco de dados (por padrão, "root" em ambientes de desenvolvimento local).
    private $password = "230669";   // Senha para o banco de dados (geralmente vazia em ambientes locais).
    public $conn;                   // Atributo público que armazenará a conexão ao banco de dados, podendo ser acessado por outras classes.

    // Método que será utilizado para obter a conexão com o banco de dados.
    public function getConnection() {
        $this->conn = null;         // Inicializa a variável de conexão ($conn) como nula.

        try {                       // Bloco try/catch tenta executar o código dentro do try e captura exceções no catch.
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            // Cria uma nova conexão usando mysqli, passando os dados de host, usuário, senha e nome do banco.
        } catch (Exception $e) {    // Se ocorrer um erro na conexão, o catch é ativado.
            echo "Erro de conexão: " . $e->getMessage(); // Mostra uma mensagem de erro explicando o problema.
        }

        return $this->conn;         // Retorna a conexão (se bem-sucedida) para ser utilizada por outras partes do sistema.
    }
}
?>
