<?php
require_once 'config.php';
require_once 'enviar_email.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtragem básica usando filter_input para garantir segurança na captura do $_POST
    $nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT) ?? '';
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT) ?? '';
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT) ?? ''; // Mantido DEFAULT caso o cliente digite algo inválido mas você queira salvar assim mesmo no banco
    $produto = filter_input(INPUT_POST, 'produto', FILTER_DEFAULT) ?? '';
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_DEFAULT) ?? '';
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_DEFAULT) ?? '';
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT) ?? '';

    // Validação de campos obrigatórios
    if (empty($nome) || empty($telefone)) {
        echo json_encode(['status' => 'error', 'message' => 'Nome e telefone são obrigatórios.']);
        exit;
    }

    try {
        // 1. Prepara e executa a query do PDO no banco
        $stmt = $pdo->prepare("INSERT INTO `orçamentos` (nome, telefone, email, produto, quantidade, cidade, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Nota: Certifique-se de que os nomes das colunas na tabela `orçamentos` batem com a ordem abaixo.
        // Alterado o sexto parâmetro para casar com a variável $cidade.
        $stmt->execute([$nome, $telefone, $email, $produto, $quantidade, $cidade, $mensagem]);
        
        // 2. Envia e-mail para o administrador
        // Se a função falhar, ela vai direto para o bloco catch abaixo capturando o erro técnico
        enviarEmailOrcamento($nome, $telefone, $email, $produto, $quantidade, $cidade, $mensagem);
        
        // Se tudo der certo até aqui, retorna o sucesso único
        echo json_encode(['status' => 'success', 'message' => 'Orçamento recebido e enviado com sucesso!']);
        
    } catch (Exception $e) {
        // Captura falhas de Banco ou de Envio de E-mail de forma organizada
        echo json_encode([
            'status' => 'error', 
            'message' => 'Ocorreu um problema no processamento: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
?>