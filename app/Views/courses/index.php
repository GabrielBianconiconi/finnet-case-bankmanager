<?php
?>

<div class="page-header">
    <h1>Gerenciamento de Cursos</h1>
    <a href="/courses/create" class="btn btn-primary">Novo Curso</a>
</div>

<div class="content-table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['id']) ?></td>
                        <td><?= htmlspecialchars($course['title']) ?></td>
                        <td><?= htmlspecialchars($course['description']) ?></td>
                        <td class="actions">
                            <a href="/courses/edit?id=<?= $course['id'] ?>" class="btn btn-secondary">Editar</a>
                            <a href="/courses/delete?id=<?= $course['id'] ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum curso encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
