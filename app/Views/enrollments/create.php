<div class="container">
    <h1>Realizar Nova Matrícula</h1>

    <form action="/enrollments/store" method="POST" class="form-default">
        <div class="form-group">
            <label for="student_id">Selecione o Aluno</label>
            <select id="student_id" name="student_id" required>
                <option value="">-- Escolha um aluno --</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= htmlspecialchars($student['id']) ?>"><?= htmlspecialchars($student['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="course_id">Selecione o Curso</label>
            <select id="course_id" name="course_id" required>
                <option value="">-- Escolha um curso --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= htmlspecialchars($course['id']) ?>"><?= htmlspecialchars($course['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Matricular Aluno</button>
            <a href="/enrollments" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
