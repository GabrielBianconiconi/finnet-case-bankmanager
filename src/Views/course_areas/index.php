<?php
?>

<div class="container">
    <div class="header">
        <h1>Gerenciamento de Áreas de Cursos</h1>
        <a href="/course-areas/create" class="btn">Nova Área</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($courseAreas)):
                foreach ($courseAreas as $area):
            ?>
                    <tr>
                        <td><?= htmlspecialchars($area['id']) ?></td>
                        <td><?= htmlspecialchars($area['name']) ?></td>
                        <td class="actions">
                            <a href="/course-areas/edit?id=<?= $area['id'] ?>" class="btn-edit">Editar</a>
                            <a href="/course-areas/delete?id=<?= $area['id'] ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta área?');">Excluir</a>
                        </td>
                    </tr>
            <?php
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="3">Nenhuma área de curso encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
