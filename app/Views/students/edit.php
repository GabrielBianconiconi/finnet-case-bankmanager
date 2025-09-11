<div class="container">
    <h1>Editar Aluno</h1>

    <form action="/students/update/<?= htmlspecialchars($student['id']) ?>" method="POST" class="form-default">
        <div class="form-group">
            <label for="name">Nome Completo</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="birth_date">Data de Nascimento</label>
            <input type="date" id="birth_date" name="birth_date" value="<?= htmlspecialchars($student['birth_date']) ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar Aluno</button>
            <a href="/students" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
