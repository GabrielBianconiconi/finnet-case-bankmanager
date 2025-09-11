<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Administrativo</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        /* Estilos específicos para a página de login */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f7f6;
            font-family: 'Inter', sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #333;
        }
        .login-container p {
            margin-bottom: 30px;
            color: #666;
        }
        .login-container .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box; /* Garante que o padding não afete a largura total */
        }
        .login-container .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container .btn:hover {
            background-color: #0056b3;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>BankManager</h1>
        <p>Acesse o painel administrativo</p>

        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
</html>
