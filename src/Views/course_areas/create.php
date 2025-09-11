<?php
$pageTitle = 'Adicionar Nova Área de Curso';
?>

<div class="form-container">
    <h1>Adicionar Nova Área de Curso</h1>
    <p>Preencha o campo abaixo para cadastrar uma nova área.</p>

    <form action="/course-areas/store" method="POST" class="form-card">
        
        <div class="form-group">
            <label for="nome">Nome da Área</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Biologia" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/course-areas" class="btn btn-secondary">Voltar</a>
        </div>
        
    </form>
</div>