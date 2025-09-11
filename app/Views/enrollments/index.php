<div class="container">
    <h1>Gerenciamento de Matrículas</h1>
    <a href="/enrollments/create" class="btn btn-primary">Nova Matrícula</a>

    <table class="table">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Data da Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enrollments as $enrollment): ?>
                <tr>
                    <td><?= htmlspecialchars($enrollment['student_name']) ?></td>
                    <td><?= htmlspecialchars($enrollment['course_title']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($enrollment['enrollment_date']))) ?></td>
                    <td>
                        <a href="#" class="btn btn-danger">Cancelar Matrícula</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
