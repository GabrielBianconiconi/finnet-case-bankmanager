<div class="container">
    <h1>Gerenciamento de Alunos</h1>
    <a href="/students/create" class="btn btn-primary">Novo Aluno</a>

    <form class="search-form" method="GET" action="/students">
        <input type="text" name="search" placeholder="Buscar por nome ou e-mail...">
        <button type="submit" class="btn">Buscar</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['id']) ?></td>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($student['birth_date']))) ?></td>
                    <td>
                        <a href="/students/edit/<?= htmlspecialchars($student['id']) ?>" class="btn btn-secondary">Editar</a>
                        <a href="#" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
