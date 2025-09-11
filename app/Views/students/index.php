<div class="container">
    <h1>Gerenciamento de Alunos</h1>
    <a href="/students/create" class="btn btn-primary">Novo Aluno</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['id']) ?></td>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td class="actions">
                        <a href="/students/edit/<?= htmlspecialchars($student['id']) ?>" class="btn btn-secondary">Editar</a>
                        <form action="/students/delete/<?= htmlspecialchars($student['id']) ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');" style="display: inline;">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
