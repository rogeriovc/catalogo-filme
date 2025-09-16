<?php

require_once __DIR__."/../config/database.php";

// classe que representa a tabela filme no projeto
class Filme {
    private $tabela = "filme";
    private $pdo;

    // colunas da tabela
    public $id;
    public $nome;
    public $ano;
    public $descricao;
    public $img;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /**
     * Busca todos os filmes
     */
    public function buscar_todos(){
        try {
            $query = "SELECT * FROM {$this->tabela} ORDER BY nome";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Erro ao buscar filmes: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Busca filme por ID
     */
    public function buscar_id($id){
        try {
            $query = "SELECT * FROM {$this->tabela} WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Erro ao buscar filme por ID: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Exclui filme
     */
    public function excluir($id){
        try {
            $query = "DELETE FROM {$this->tabela} WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao excluir filme: " . $e->getMessage());
            return false;
        }
    }   

    /**
     * Cadastra novo filme
     */
    public function cadastro($nome, $ano, $descricao, $img = null){
        try {
            // Se não foi fornecida imagem, usar uma padrão
            if (empty($img)) {
                $img = "https://via.placeholder.com/300x450/555555/ffffff?text=" . urlencode($nome);
            }
            
            $query = "INSERT INTO {$this->tabela}(nome, ano, descricao, img) VALUES(:nome, :ano, :descricao, :img)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":ano", $ano, PDO::PARAM_INT);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":img", $img, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar filme: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Edita filme existente
     */
    public function editar_filme($id, $nome, $ano, $descricao, $img = null) {
        try {
            // Se não foi fornecida imagem, usar uma padrão
            if (empty($img)) {
                $img = "https://via.placeholder.com/300x450/555555/ffffff?text=" . urlencode($nome);
            }
            
            $query = "UPDATE {$this->tabela} SET nome = :nome, ano = :ano, descricao = :descricao, img = :img WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':img', $img, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao editar filme: " . $e->getMessage());
            return false;
        }
    }
}