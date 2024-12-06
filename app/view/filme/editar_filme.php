<?php
require_once __DIR__."\..\..\model\Filme.php";
 
$filmeModel = new Filme();
 
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];
 
    $sucesso = false;
   
    if(empty($id)){
            //fluxo para editar
 
            $nome = $_POST["nome"];
            $ano = $_POST["ano"];
            $descricao = $_POST["descricao"];
 
            $sucesso = $filmeModel->editar_filme($id,$nome,$ano,$descricao);
    } else {
 
   
            $nome = $_POST["nome"];
            $ano = $_POST["ano"];
            $descricao = $_POST["descricao"];
 
            $sucesso = $filmeModel->cadastro($nome, $ano, $descricao);
    }
   
    if($sucesso){
        return header("Location: listar.php?mensagem=sucesso");
    } else{
        return header("Location: listar.php?mensagem=erro");
    }
}else if($_SERVER["REQUEST_METHOD"] === "GET"){
 
 
    $filme = null;
 
    if(!empty($_GET['id'])){

       $filme = $filmeModel->buscar_id($_GET['id']);
    }else{

        $filme = new Filme();
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

</head>
<body>
<section class="container">
        <form action="editar_filme.php" method="POST">
            <h2>Editar/Atualizar Filme</h2>
            <div>
                <label for="">Nome do filme:</label>
                <input type="text" id = "nome" name="nome"  placeholder="nome do filme..." value="<?php echo $filme->nome?>">
            </div>
 
            <div>
                <label for="">Ano de lançamento:</label>
                <input type="int" id="ano" name="ano"  placeholder="ano de lançamento..." value="<?php echo $filme->ano?>">
            </div>
 
            <div>
                <label for="">Descrição do filme:</label>
                <input type="text" id="descricao" name="descricao"  placeholder="descrição..." value="<?php echo $filme->descricao?>">
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