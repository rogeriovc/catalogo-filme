<?php
require_once __DIR__. "/../../model/Filme.php";
require_once __DIR__ . "/../../config/env.php";
require_once __DIR__ . "/../../config/database.php";

$erro_msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = trim($_POST["nome"] ?? '');
    $ano = (int)($_POST["ano"] ?? 0);
    $descricao = trim($_POST["descricao"] ?? '');
    $img = trim($_POST["img"] ?? '');
    
    // Validações
    if (empty($nome)) {
        $erro_msg = "Nome é obrigatório";
    } elseif ($ano < 1900 || $ano > 2030) {
        $erro_msg = "Ano deve estar entre 1900 e 2030";
    } elseif (empty($descricao)) {
        $erro_msg = "Descrição é obrigatória";
    } else {
        $filmeModel = new Filme();
        $sucesso = $filmeModel->cadastro($nome, $ano, $descricao, $img);
        
        if ($sucesso){
            header("Location: listar.php?mensagem=sucesso");
            exit;
        } else {
            $erro_msg = "Erro ao salvar filme";
        }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
</head>
<body>
<section class="cadastroc">
    <?php if($erro_msg): ?>
        <div style="background: #ff4444; color: white; padding: 10px; margin: 10px; border-radius: 5px;">
            ❌ <?php echo htmlspecialchars($erro_msg); ?>
        </div>
    <?php endif; ?>

    <form action="cadastro.php" method="POST">
        <h2>Cadastro de Filmes</h2>
        
        <div>
            <label for="nome">Nome do filme:</label>
            <input type="text" id="nome" name="nome" required 
                   placeholder="nome do filme..."
                   value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
        </div>
 
        <div>
            <label for="ano">Ano de lançamento:</label>
            <input type="number" id="ano" name="ano" required 
                   min="1900" max="2030" 
                   placeholder="ano de lançamento..."
                   value="<?php echo htmlspecialchars($_POST['ano'] ?? ''); ?>">
        </div>
 
        <div>
            <label for="descricao">Descrição do filme:</label>
            <textarea id="descricao" name="descricao" required 
                      placeholder="descrição..." 
                      rows="4"><?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?></textarea>
        </div>
 
        <div>
            <label for="img">URL da Imagem:</label>
            <input type="url" id="img" name="img" 
                   placeholder="https://exemplo.com/imagem.jpg"
                   value="<?php echo htmlspecialchars($_POST['img'] ?? ''); ?>">
            <small>Deixe em branco para usar imagem padrão</small>
        </div>
 
        <button type="submit">Salvar</button>
    </form>

    <form action="listar.php" method="GET">
        <button type="submit" title="voltar">
            <span class="material-symbols-outlined">arrow_back</span>
        </button>
    </form>
</section>

<script>
// Preview da imagem
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
        preview.style.display = 'block';
        preview.onerror = function() {
            this.style.display = 'none';
        };
        this.parentNode.appendChild(preview);
    }
});
</script>
</body>
</html>