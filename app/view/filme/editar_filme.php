<?php

require_once __DIR__. "\..\..\model\Filme.php";
require_once __DIR__ . "\..\..\config/env.php";
require_once __DIR__ . "\..\..\config\database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    print_r($_POST);
    $id= $_POST["id"];
    $nome = $_POST["nome"];
    $ano = $_POST["ano"];
    $descricao = $_POST["descricao"];
    
    $filmeModel= new Filme();
    $sucesso = $filmeModel->editar_filme( $id,$nome ,$ano,$descricao);
    
    if ($sucesso){
        return header("Location: listar.php?mensagem=sucesso");
        }
    else {
        return header("Location: listar.php?mensagem=erro");
    }
    } 


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
    <link rel="stylesheet" href="/catalogo-filme/public/CSS/style.css">
    <link rel="stylesheet" href="/catalogo-filme/view/filme/editar_filme.php">
</head>
<body>
<section class="container">
        <form action="editar_filme.php" method="POST">
            <h2>Editar/Atualizar Filme</h2>
            <div>
                <label for="">Nome do filme:</label>
                <input type="text" id = "nome" name="nome"  placeholder="nome do filme...">
            </div>
 
            <div>
                <label for="">Ano de lançamento:</label>
                <input type="int" id="ano" name="ano"  placeholder="ano de lançamento...">
            </div>
 
            <div>
                <label for="">Descrição do filme:</label>
                <input type="text" id="descricao" name="descricao"  placeholder="descrição...">
            </div>
 
            <button>Salvar</button>
        </form>

        <form action="listar.php" method="GET">
        <button title="voltar">
        <span class="material-symbols-outlined">
            arrow_back
        </span>
        </button>
    </form>
    </section>
</body>
</html>