<?php
$pageTitle = 'Adicionar Novo Curso';
?>

<div class="container">
    <h1>Adicionar Novo Curso</h1>

    <form action="/courses/store" method="POST" class="form">
        
        <div class="form-group">
            <label for="title">Título do Curso</label>
            <input type="text" id="title" name="title" required>
            <small>O nome principal do curso. Ex: Biologia Celular.</small>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" rows="4"></textarea>
            <small>Uma breve descrição sobre o que será abordado no curso.</small>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar Curso</button>
            
            <a href="/courses" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
