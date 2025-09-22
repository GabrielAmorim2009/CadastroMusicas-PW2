<?php
class Musicas
{
    // Atributos correspondentes à tabela de musicas
    public $id;
    public $nome;
    public $artista;
    public $ano_lancamento;
    public $album;
    public $genero;

    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Método para cadastrar uma nova musica
    public function cadastrar(): bool
    {
        try {
            $sql = "INSERT INTO musicas (`nome`, `artista`, `ano_lancamento`, `album`, `genero`) VALUES (?, ?, ?, ?, ?)";
            $dados = [
                $this->nome,
                $this->artista,
                $this->ano_lancamento,
                $this->album,
                $this->genero
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao cadastrar musica: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar musica: " . $e->getMessage());
        }
    }

    // Método para consultar todas as musicas, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                $sql = "SELECT * FROM musicas WHERE nome LIKE ? OR artista LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM musicas";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar musicas: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar musicas: " . $e->getMessage());
        }
    }

    // Método para consultar tarefa por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM musicas WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar musica por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar musica por ID: " . $e->getMessage());
        }
    }

    // Método para alterar uma tarefa existente
    public function editar()
    {
        try {
            $sql = "UPDATE musicas SET nome = ?, artista = ?, ano_lancamento = ?, album = ?, genero = ? WHERE id = ?";
            $dados = [
                $this->nome,
                $this->artista,
                $this->ano_lancamento,
                $this->album,
                $this->genero,
                $this->id
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao alterar musica: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar musica: " . $e->getMessage());
        }
    }

    // Método para deletar uma musica
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM musicas WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar musica: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar musica: " . $e->getMessage());
        }
    }
}