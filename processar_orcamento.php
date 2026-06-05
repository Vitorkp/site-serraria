<?php
require_once 'config.php';
require_once 'enviar_email.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtragem básica usando filter_input para garantir segurança na captura do $_POST
    $nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT) ?? '';
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT) ?? '';
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? '';
    $produto = filter_input(INPUT_POST, 'produto', FILTER_DEFAULT) ?? '';
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_DEFAULT) ?? '';
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_DEFAULT) ?? '';
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT) ?? '';

    // Validação de campos obrigatórios conforme sua regra de negócios
    if (empty($nome) || empty($telefone)) {
        echo json_encode(['status' => 'error', 'message' => 'Nome e telefone são obrigatórios.']);
        exit;
    }

    try {
        // Prepara e executa a query do PDO
        $stmt = $pdo->prepare("INSERT INTO `orçamentos` (nome, telefone, email, produto, quantidade, cidade, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $telefone, $email, $produto, $quantidade, $cidade, $mensagem]);
        
        // Envia e-mail para o administrador
        enviarEmailOrcamento($nome, $telefone, $email, $produto, $quantidade, $cidade, $mensagem);
        
        echo json_encode(['status' => 'success', 'message' => 'Orçamento recebido com sucesso!']);
    } catch (Exception $e) {
        // Se der erro no banco de dados, retorna o erro tratado para o JavaScript exibir
        echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar no banco de dados: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
?>
