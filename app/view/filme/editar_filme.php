<?php
require_once __DIR__."/../../model/Filme.php";
 
$filmeModel = new Filme();
 
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"] ?? '';
    $nome = $_POST["nome"] ?? '';
    $ano = $_POST["ano"] ?? '';
    $descricao = $_POST["descricao"] ?? '';
    $img = $_POST["img"] ?? '';
 
    $sucesso = false;
   
    if(!empty($id)){
        // EDITAR filme existente
        $sucesso = $filmeModel->editar_filme($id, $nome, $ano, $descricao, $img);
    } else {
        // CADASTRAR novo filme
        $sucesso = $filmeModel->cadastro($nome, $ano, $descricao, $img);
    }
   
    if($sucesso){
        return header("Location: listar.php?mensagem=sucesso");
    } else{
        return header("Location: listar.php?mensagem=erro");
    }
    
} else if($_SERVER["REQUEST_METHOD"] === "GET"){
    $filme = null;
 
    if(!empty($_GET['id'])){
        $filme = $filmeModel->buscar_id($_GET['id']);
    } else {
        $filme = new Filme();
        $filme->nome = '';
        $filme->ano = '';
        $filme->descricao = '';
        $filme->img = '';
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
        <h2><?php echo !empty($filme->id) ? 'Editar' : 'Cadastrar'; ?> Filme</h2>
        
        <!-- Campo oculto para ID (só quando editando) -->
        <?php if(!empty($filme->id)): ?>
            <input type="hidden" name="id" value="<?php echo $filme->id; ?>">
        <?php endif; ?>
        
        <div>
            <label for="nome">Nome do filme:</label>
            <input type="text" id="nome" name="nome" required 
                   placeholder="nome do filme..." 
                   value="<?php echo htmlspecialchars($filme->nome ?? ''); ?>">
        </div>
 
        <div>
            <label for="ano">Ano de lançamento:</label>
            <input type="number" id="ano" name="ano" required 
                   min="1900" max="2030"
                   placeholder="ano de lançamento..." 
                   value="<?php echo htmlspecialchars($filme->ano ?? ''); ?>">
        </div>
 
        <div>
            <label for="descricao">Descrição do filme:</label>
            <textarea id="descricao" name="descricao" required 
                      placeholder="descrição..." 
                      rows="4"><?php echo htmlspecialchars($filme->descricao ?? ''); ?></textarea>
        </div>

        <div>
            <label for="img">URL da Imagem:</label>
            <input type="url" id="img" name="img" 
                   placeholder="https://exemplo.com/imagem.jpg" 
                   value="<?php echo htmlspecialchars($filme->img ?? ''); ?>">
        </div>

        <!-- Preview da imagem -->
        <?php if(!empty($filme->img)): ?>
        <div>
            <label>Preview atual:</label>
            <img src="<?php echo htmlspecialchars($filme->img); ?>" 
                 alt="Preview" style="max-width: 200px; height: auto;">
        </div>
        <?php endif; ?>
 
        <button type="submit">Salvar</button>
    </form>

    <form action="listar.php" method="GET">
        <button type="submit" title="voltar">
            <span class="material-symbols-outlined">arrow_back</span>
        </button>
    </form>
</section>

<script>
// Preview da imagem em tempo real
document.getElementById('img').addEventListener('input', function() {
    const url = this.value;
    let preview = document.getElementById('img-preview');
    
    if (preview) {
        preview.remove();
    }
    
    if (url) {
        preview = document.createElement('img');
        preview.id = 'img-preview';
        preview.src = url;
        preview.style.maxWidth = '200px';
        preview.style.height = 'auto';
        preview.style.marginTop = '10px';
        preview.onerror = function() {
            this.style.display = 'none';
        };
        this.parentNode.appendChild(preview);
    }
});
</script>
</body>
</html>