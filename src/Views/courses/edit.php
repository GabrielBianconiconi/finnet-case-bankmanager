<?php
$pageTitle = 'Editar Curso';
?>

<div class="container">
    <h1>Editar Curso</h1>
    <form action="/courses/update/<?= htmlspecialchars($course['id']) ?>" method="POST" class="form">
        
        <div class="form-group">
            <label for="title">Título do Curso</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($course['title']) ?>" required>
            <small>O nome principal do curso.</small>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($course['description']) ?></textarea>
            <small>Uma breve descrição sobre o que será abordado no curso.</small>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar Curso</button>
            
            <a href="/courses" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
