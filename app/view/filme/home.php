<?php

require_once __DIR__."\..\..\model\Filme.php";


$filmeModel = new Filme();
$filmes = $filmeModel-> buscar_todos();


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="/catalogo-filme/public/CSS/style.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="cadastro.php">CADASTRO</a></li>
                <li><a href="home.php">HOME</a></li>
                <li><a href="listar.php">LISTAR</a></li>
            </ul>
        </nav>
    </header>   

    <section class="container_card">

        <?php foreach($filmes as $filme) { ?>
            <div class="cards">
                <img class="img" src="<?php echo $filme->img?>" alt="">
                <div>
                <h3 class="titulo"> <?php echo $filme->nome?></h3>
                <span class="descricao"><?php echo $filme->descricao?></span>
                </div>
            </div>
        <?php } ?>
    </section>

</body>
</html>
