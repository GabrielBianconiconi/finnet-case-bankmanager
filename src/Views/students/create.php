<div class="container">
    <h1>Adicionar Novo Aluno</h1>

    <form action="/students/store" method="POST" class="form-default">
        <div class="form-group">
            <label for="name">Nome Completo</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="birth_date">Data de Nascimento</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar Aluno</button>
            <a href="/students" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
