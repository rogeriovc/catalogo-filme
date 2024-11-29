<?php

require_once __DIR__."\..\config\database.php";

// classe que representa a tabela filme no projeto

class Filme {

    private $tabela = "filme";
    private $pdo ;

    // colunas da tabela
    public $id;
    public $nome;
    public $ano;
    public $descricao;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    //metodo que busca todos os filmes
    public function buscar_todos(){

    $query = "SELECT * FROM $this->tabela";
    $stmt =  $this->pdo->prepare(query: $query);
    $stmt->execute();
    $stmt-> setFetchMode(PDO::FETCH_CLASS, __CLASS__);
    
    return  $stmt->fetchAll();
 
    }
    //public function findById($id){
        //$query = "SELECT * FROM  $this->tabela WHERE id = :id";
        //$stmt = $this->pdo->prepare($query);
        //$stmt->bindParam(":id", $id, type: PDO::PARAM_INT);
        //$stmt->execute();
        //return $stmt->fetch();
    //}

    //metodo para buscar filme por id
    public function buscar_id($id){
        $query = "SELECT * FROM $this->tabela WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", var: $id, type: PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $stmt->fetch();
}
    public function excluir($id){
        $query = "DELETE FROM $this->tabela WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", var: $id, type: PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
}   

    public function cadastro($nome,$ano,$descricao){
        $query = "INSERT INTO $this->tabela(nome, ano, descricao) VALUES(:nome, :ano, :descricao)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":nome", var: $nome);
        $stmt->bindParam(":ano", var: $ano, type: PDO::PARAM_INT);
        $stmt->bindParam(":descricao", var: $descricao, type: PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $stmt->rowCount() > 0;
    }
    
    public function editar_filme($id, $nome, $ano, $descricao) {
        $query = "UPDATE $this->tabela SET nome = :nome, ano = :ano, descricao = :descricao WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', var: $id, type: PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $stmt->rowCount() > 0;
    }
}