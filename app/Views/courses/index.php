<?php
?>

<div class="container">
    <h1>Gerenciamento de Cursos</h1>
    <a href="/courses/create" class="btn btn-primary">Novo Curso</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['id']) ?></td>
                    <td><?= htmlspecialchars($course['title']) ?></td>
                    <td><?= htmlspecialchars($course['description']) ?></td>
                    <td class="actions">
                        <a href="/courses/edit/<?= htmlspecialchars($course['id']) ?>" class="btn btn-secondary">Editar</a>
                        <form action="/courses/delete/<?= htmlspecialchars($course['id']) ?>" method="POST" onsubmit="return confirm('Você tem certeza que deseja excluir este curso?');" style="display: inline;">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>