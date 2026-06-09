<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: admin.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['pode_gerenciar'] = $usuario['pode_gerenciar_usuarios'];
        header('Location: admin.php');
        exit;
    } else {
        // Fallback para o admin inicial se o banco estiver vazio ou hash não bater (apenas para o primeiro acesso conforme solicitado)
        if ($email === 'admin@florestalpinus.com' && $senha === 'admin123!') {
            // Cria o usuário se não existir
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() == 0) {
                $hash = password_hash('admin123!', PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, pode_gerenciar_usuarios) VALUES (?, ?, ?, ?)");
                $stmt->execute(['Admin Inicial', $email, $hash, 1]);
                
                $_SESSION['usuario_id'] = $pdo->lastInsertId();
                $_SESSION['usuario_nome'] = 'Admin Inicial';
                $_SESSION['pode_gerenciar'] = 1;
                header('Location: admin.php');
                exit;
            }
        }
        $erro = 'E-mail ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - Florestal Pinus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 40px;
            background: var(--creme);
            border-radius: 16px;
            box-shadow: 0 10px 25px var(--sombra);
        }
        .login-container h2 {
            text-align: center;
            color: var(--verde);
            margin-bottom: 30px;
        }
        .erro {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="logo-florestal.png" alt="Logo" class="header-logo">
            <div class="logo-text">Florestal Pinus <span>Sul Brasil</span></div>
        </div>
        <nav><a href="index.html">Voltar ao Site</a></nav>
    </header>

    <main>
        <div class="login-container">
            <h2>Área Administrativa</h2>
            <?php if ($erro): ?>
                <div class="erro"><?php echo $erro; ?></div>
            <?php endif; ?>
            <form action="login.php" method="POST" class="formulario">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required placeholder="admin@florestalpinus.com">
                
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required placeholder="******">
                
                <button type="submit">Entrar</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Florestal Pinus - Área Administrativa</p>
    </footer>
</body>
</html>
