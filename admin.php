<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$aba = $_GET['aba'] ?? 'orcamentos';

// Lógica de exclusão de orçamento
if (isset($_GET['excluir_orcamento'])) {
    $stmt = $pdo->prepare("DELETE FROM orçamentos WHERE id = ?");
    $stmt->execute([$_GET['excluir_orcamento']]);
    header('Location: admin.php?aba=orcamentos');
    exit;
}

// Processamento de Configurações
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao_config'])) {
    if ($_POST['acao_config'] === 'salvar_email') {
        $email_orcamentos = filter_input(INPUT_POST, 'email_orcamentos', FILTER_VALIDATE_EMAIL);
        
        if ($email_orcamentos) {
            $stmt = $pdo->prepare("INSERT INTO configuracoes (chave, valor, descricao) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE valor = ?");
            $stmt->execute(['email_orcamentos', $email_orcamentos, 'E-mail para receber orçamentos', $email_orcamentos]);
            header('Location: admin.php?aba=configuracoes&sucesso=1');
            exit;
        }
    }
}

// Processamento de Produtos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao_produto'])) {
    $nome = $_POST['nome'];
    $nome_en = $_POST['nome_en'] ?? '';
    $descricao = $_POST['descricao'];
    $descricao_en = $_POST['descricao_en'] ?? '';
    $mercado = $_POST['mercado'] ?? 'Mercado Interno';
    $foto_nome = '';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_nome = time() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto_nome);
    }

    if ($_POST['acao_produto'] === 'cadastrar') {
        $stmt = $pdo->prepare("INSERT INTO produtos (nome, nome_en, descricao, descricao_en, mercado, foto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $nome_en, $descricao, $descricao_en, $mercado, $foto_nome]);
    } elseif ($_POST['acao_produto'] === 'editar') {
        $id = $_POST['id'];
        if ($foto_nome) {
            $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, nome_en = ?, descricao = ?, descricao_en = ?, mercado = ?, foto = ? WHERE id = ?");
            $stmt->execute([$nome, $nome_en, $descricao, $descricao_en, $mercado, $foto_nome, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, nome_en = ?, descricao = ?, descricao_en = ?, mercado = ? WHERE id = ?");
            $stmt->execute([$nome, $nome_en, $descricao, $descricao_en, $mercado, $id]);
        }
    }
    header('Location: admin.php?aba=produtos');
    exit;
}

if (isset($_GET['excluir_produto'])) {
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$_GET['excluir_produto']]);
    header('Location: admin.php?aba=produtos');
    exit;
}

// Processamento de Usuários
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao_usuario']) && $_SESSION['pode_gerenciar']) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $pode_gerenciar = isset($_POST['pode_gerenciar']) ? 1 : 0;

    if ($_POST['acao_usuario'] === 'cadastrar') {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, pode_gerenciar_usuarios) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senha, $pode_gerenciar]);
    } elseif ($_POST['acao_usuario'] === 'editar') {
        $id = $_POST['id'];
        if (!empty($_POST['senha'])) {
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, pode_gerenciar_usuarios = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $senha, $pode_gerenciar, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, pode_gerenciar_usuarios = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $pode_gerenciar, $id]);
        }
    }
    header('Location: admin.php?aba=usuarios');
    exit;
}

if (isset($_GET['excluir_usuario']) && $_SESSION['pode_gerenciar']) {
    if ($_GET['excluir_usuario'] != $_SESSION['usuario_id']) {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$_GET['excluir_usuario']]);
    }
    header('Location: admin.php?aba=usuarios');
    exit;
}

// Buscar dados para edição de produto
$produto_edicao = null;
if (isset($_GET['editar_produto'])) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$_GET['editar_produto']]);
    $produto_edicao = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Florestal Pinus</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-nav {
            background: var(--verde);
            padding: 10px 8%;
            display: flex;
            gap: 20px;
            overflow-x: auto;
        }
        .admin-nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            white-space: nowrap;
        }
        .admin-nav a.active {
            background: var(--marrom);
        }
        .admin-content {
            padding: 40px 8%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px var(--sombra);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background: var(--verde-claro);
            color: white;
        }
        .btn-acao {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
        }
        .btn-edit { background: #ffc107; color: black; }
        .btn-del { background: #dc3545; color: white; }
        .form-admin {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px var(--sombra);
        }
        .welcome {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Florestal <span>Pinus</span></div>
        <div class="header-actions">
            <span style="color: white">Olá, <?php echo $_SESSION['usuario_nome']; ?></span>
            <a href="logout.php" class="login-topo">Sair</a>
        </div>
    </header>

    <nav class="admin-nav">
        <a href="?aba=orcamentos" class="<?php echo $aba == 'orcamentos' ? 'active' : ''; ?>">Orçamentos</a>
        <a href="?aba=produtos" class="<?php echo $aba == 'produtos' ? 'active' : ''; ?>">Produtos</a>
        <a href="?aba=configuracoes" class="<?php echo $aba == 'configuracoes' ? 'active' : ''; ?>">Configurações</a>
        <?php if ($_SESSION['pode_gerenciar']): ?>
        <a href="?aba=usuarios" class="<?php echo $aba == 'usuarios' ? 'active' : ''; ?>">Usuários</a>
        <?php endif; ?>
    </nav>

    <main class="admin-content">
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert-success">Configuração salva com sucesso!</div>
        <?php endif; ?>

        <?php if ($aba == 'orcamentos'): ?>
            <h2>Visualização de Orçamentos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Produto</th>
                        <th>Cidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM orçamentos ORDER BY data_envio DESC");
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                            <td>".date('d/m/Y H:i', strtotime($row['data_envio']))."</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['telefone']}</td>
                            <td>{$row['produto']}</td>
                            <td>{$row['cidade']}</td>
                            <td>
                                <a href='?aba=orcamentos&excluir_orcamento={$row['id']}' class='btn-acao btn-del' onclick='return confirm(\"Excluir?\")'>Excluir</a>
                            </td>
                        </tr>
                        <tr>                            
                            <td colspan='6'><strong>Mensagem:</strong> {$row['mensagem']}</td>                            
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>

        <?php elseif ($aba == 'produtos'): ?>
            <h2>Cadastro de Produtos</h2>
            <div class="form-admin">
                <h3><?php echo $produto_edicao ? 'Editar Produto' : 'Novo Produto'; ?></h3>
                <form action="admin.php?aba=produtos" method="POST" enctype="multipart/form-data" class="formulario">
                    <input type="hidden" name="acao_produto" value="<?php echo $produto_edicao ? 'editar' : 'cadastrar'; ?>">
                    <?php if ($produto_edicao): ?>
                        <input type="hidden" name="id" value="<?php echo $produto_edicao['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-row">
                        <div>
                            <label>Nome (Português)</label>
                            <input type="text" name="nome" required value="<?php echo $produto_edicao['nome'] ?? ''; ?>">
                        </div>
                        <div>
                            <label>Nome (Inglês)</label>
                            <input type="text" name="nome_en" value="<?php echo $produto_edicao['nome_en'] ?? ''; ?>">
                        </div>
                    </div>
                    
                    <label>Descrição (Português)</label>
                    <textarea name="descricao" rows="3"><?php echo $produto_edicao['descricao'] ?? ''; ?></textarea>
                    
                    <label>Descrição (Inglês)</label>
                    <textarea name="descricao_en" rows="3"><?php echo $produto_edicao['descricao_en'] ?? ''; ?></textarea>
                    
                    <label>Mercado</label>
                    <select name="mercado" required>
                        <option value="Mercado Interno" <?php echo ($produto_edicao['mercado'] ?? '') === 'Mercado Interno' ? 'selected' : ''; ?>>Mercado Interno</option>
                        <option value="Exportação" <?php echo ($produto_edicao['mercado'] ?? '') === 'Exportação' ? 'selected' : ''; ?>>Exportação</option>
                    </select>
                    
                    <label>Foto</label>
                    <input type="file" name="foto" accept="image/*">
                    <?php if ($produto_edicao && $produto_edicao['foto']): ?>
                        <p style="font-size: 12px; color: #666;">Foto atual: <?php echo $produto_edicao['foto']; ?></p>
                    <?php endif; ?>
                    
                    <button type="submit"><?php echo $produto_edicao ? 'Atualizar Produto' : 'Salvar Produto'; ?></button>
                    <?php if ($produto_edicao): ?>
                        <a href="?aba=produtos" style="display: inline-block; margin-left: 10px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Cancelar</a>
                    <?php endif; ?>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Mercado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
                    while ($row = $stmt->fetch()) {
                        $img = $row['foto'] ? "img/{$row['foto']}" : "img/madeira.png";
                        echo "<tr>
                            <td><img src='$img' width='50' style='border-radius: 4px;'></td>
                            <td>{$row['nome']}</td>
                            <td>" . substr($row['descricao'], 0, 50) . "...</td>
                            <td>{$row['mercado']}</td>
                            <td>
                                <a href='?aba=produtos&editar_produto={$row['id']}' class='btn-acao btn-edit'>Editar</a>
                                <a href='?aba=produtos&excluir_produto={$row['id']}' class='btn-acao btn-del' onclick='return confirm(\"Excluir?\")'>Excluir</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

        <?php elseif ($aba == 'configuracoes'): ?>
            <h2>Configurações</h2>
            <div class="form-admin">
                <h3>E-mail para Orçamentos</h3>
                <form action="admin.php?aba=configuracoes" method="POST" class="formulario">
                    <input type="hidden" name="acao_config" value="salvar_email">
                    
                    <label>E-mail para receber orçamentos</label>
                    <input type="email" name="email_orcamentos" required placeholder="seu@email.com" value="<?php 
                        $stmt = $pdo->query("SELECT valor FROM configuracoes WHERE chave = 'email_orcamentos' LIMIT 1");
                        $config = $stmt->fetch();
                        echo $config['valor'] ?? '';
                    ?>">
                    
                    <p style="font-size: 12px; color: #666; margin-top: 10px;">Os orçamentos serão enviados para este e-mail automaticamente.</p>
                    
                    <button type="submit">Salvar Configuração</button>
                </form>
            </div>

        <?php elseif ($aba == 'usuarios' && $_SESSION['pode_gerenciar']): ?>
            <h2>Cadastro de Usuários</h2>
            <div class="form-admin">
                <h3>Novo Usuário</h3>
                <form action="admin.php?aba=usuarios" method="POST" class="formulario">
                    <input type="hidden" name="acao_usuario" value="cadastrar">
                    <label>Nome</label>
                    <input type="text" name="nome" required>
                    <label>E-mail</label>
                    <input type="email" name="email" required>
                    <label>Senha</label>
                    <input type="password" name="senha" required>
                    <label style="display:inline-block; width: auto;">
                        <input type="checkbox" name="pode_gerenciar" style="width: auto;"> Pode gerenciar outros usuários
                    </label>
                    <button type="submit" style="margin-top: 15px;">Cadastrar Usuário</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Admin?</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY nome");
                    while ($row = $stmt->fetch()) {
                        $admin = $row['pode_gerenciar_usuarios'] ? 'Sim' : 'Não';
                        echo "<tr>
                            <td>{$row['nome']}</td>
                            <td>{$row['email']}</td>
                            <td>$admin</td>
                            <td>
                                <a href='?aba=usuarios&excluir_usuario={$row['id']}' class='btn-acao btn-del' onclick='return confirm(\"Excluir?\")'>Excluir</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
