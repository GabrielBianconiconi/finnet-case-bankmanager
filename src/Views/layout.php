<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | BankManager' : 'BankManager' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <!-- Menu Lateral Vertical -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/bank-manager" class="logo">BM</a>
            </div>
            <nav class="sidebar-nav">
                <a href="/course-areas" title="Áreas de Cursos"><i class="fa-solid fa-graduation-cap"></i></a>
                <a href="/courses" title="Cursos"><i class="fa-solid fa-book"></i></a>
                <a href="/students" title="Alunos"><i class="fa-solid fa-user-group"></i></a>
                <a href="/enrollments" title="Matrículas"><i class="fa-solid fa-id-card"></i></a>
            </nav>
            <div class="sidebar-footer">
                 <a href="/logout" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="main-content">
            <header class="main-header">
                <h2><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Painel' ?></h2>
            </header>
            <div class="content-body">
                <?= $content ?? '' ?>
            </div>
        </main>
    </div>

    <script src="/js/script.js"></script>
</body>
</html>
