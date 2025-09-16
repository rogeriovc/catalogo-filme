<?php

require_once __DIR__."\..\..\model\Filme.php";


$filmeModel = new Filme();
$filmes = $filmeModel-> buscar_todos();

#echo "<pre>";
#print_r($stmt->fetchAll());
#echo "</pre>";


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="/catalogo-filme/public/CSS/style.css">

</head>
<body>
<section class="container">
    <h2>Filmes</h2>
    
    <div class="acao">
        <a href="cadastro.php">
            <button>
                <span>NOVO</span>
                <span class="material-symbols-outlined">
                    add
                </span>

            </button>
        </a>
    </div>

    <div class="home">
        <a href="home.php">
            <button>
            <span class="material-symbols-outlined">
                home
            </span>        
            </button>
        </a>
    </div>

    </div>
<table class="table">
    <thead>
        <th>ID</th>
        <th>NOME</th>
        <th>ANO</th>
        <th>DESCRIÇÃO</th>
        <th>IMG</th>
        <th>AÇÃO</th>
    </thead>
    <tbody>
    <?php foreach($filmes as $filme) {?>

        <tr>
            <td><?php echo $filme->id?></td>
            <td><?php echo $filme->nome?></td>
            <td><?php echo $filme->ano?></td>
            <td><?php echo $filme->descricao?></td>
            <td><img src="<?php echo $filme->img?>" alt=""></td>
            <td>
                <form action="visualizar.php" method="GET">
                    <input type="hidden" name="id" value="<?= $filme->id; ?>">
                    <button title="detalhes">

                        <span class="material-symbols-outlined">
                        visibility
                        </span>
                    </button>
                </form>

                <form action="excluir.php" method="POST">
                <input type="hidden" name="id" value="<?= $filme->id; ?>">            
                <button onclick="return confirm('tem certeza que deseja excluir')">           
                <span class="material-symbols-outlined">
                        delete
                </span>
                </button>
                </form>

                <form action="editar_filme.php" method="GET">
                    <input type="hidden" name="id" value="<?= $filme->id; ?>">
                    <button>
                    <span class="material-symbols-outlined">
                    update
                    </span>
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>

    </tbody>  
</table>  
</section>
<script src="/catalogo-filme/public/js/main.js" defer></script>
</body>
</html>

        