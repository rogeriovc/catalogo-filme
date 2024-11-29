<?php

require_once __DIR__. "\..\..\model\Filme.php";
require_once __DIR__ . "/../../config/env.php";
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
print_r($_POST);
$nome = $_POST["nome"];
$ano = $_POST["ano"];
$descricao = $_POST["descricao"];

$filmeModel= new Filme();
$sucesso = $filmeModel->cadastro($nome, $ano, $descricao);

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
    <title>Cadastro</title>
    <link rel="stylesheet" href="/catalogo-filme/public/CSS/style.css">
    <link rel="stylesheet" href="/catalogo-filme/view/filme/cadastro.php">
</head>
<body>
<!--    <div class="container_2">
        <h2>Cadastro de Filmes</h2>
        <label for="insira o nome">insira o titulo</label>
        <input type="text"name="insira o nome" placeholder="nome do filme" required>

        <label for="insira o ano">insira o titulo</label>
        <input type="int"name="insira o ano" placeholder="ano de lançamento" required>

        <label for="descricao">descrição do filme</label>
        <input type="text"name="insira a descricao" placeholder="descricao do filme" required>

    </div>
    <section class="container_2"> 
    <form action="Filme.php" method="POST">
        <button>
            Cadastrar
        </button>
    </form>
    </section>
    <script src="/catalogo-filme/public/js/main.js" defer></script>
-->
<section class="container">
        <form action="cadastro.php" method="POST">
            <h2>Cadastro de Filmes</h2>
            <div>
                <label for="">Nome do filme:</label>
                <input type="text" name="nome" required placeholder="nome do filme...">
            </div>
 
            <div>
                <label for="">Ano de lançamento:</label>
                <input type="text" name="ano" required placeholder="ano de lançamento...">
            </div>
 
            <div>
                <label for="">Descrição do filme:</label>
                <input type="text" name="descricao" required placeholder="descrição...">
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
