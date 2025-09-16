<?php

require_once __DIR__ . "/../../config/env.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../model/Filme.php";

$id = $_GET["id"];

if ($id == "") {
    return header(header:"Location: listar.php");
}

$filmeModel = new Filme();
$filme = $filmeModel->buscar_id(id: $id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILMES</title>
    <link rel="stylesheet" href="/catalogo-filme/public/CSS/style.css">
</head>
<body>
    <section class="container">
    <h2>detalhes do filme</h2>
    <h3>Nome: <?php echo $filme->nome?></h3>
    <p>Ano: <?php echo $filme->ano?></p>
    <p>Descrição: <?php echo $filme->descricao?></p>
    <p>Imagem:<img src="<?php echo $filme->img?>" alt=""></p>



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

