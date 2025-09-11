<?php
$pageTitle = 'Editar Área de Curso';

$nomeAtual = isset($courseArea) ? htmlspecialchars($courseArea->nome) : '';
$id = isset($courseArea) ? (int)$courseArea->id : 0;
?>

<div class="form-container">
    <h1>Editar Área de Curso</h1>
    <p>Altere o nome da área de curso abaixo.</p>

    <form action="/course-areas/update" method="POST" class="form-card">

        <input type="hidden" name="id" value="<?= $id ?>">
        
        <div class="form-group">
            <label for="nome">Nome da Área</label>
            <input type="text" id="nome" name="nome" value="<?= $nomeAtual ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="/course-areas" class="btn btn-secondary">Voltar</a>
        </div>
        
    </form>
</div>