<?php
require_once 'config.php';

header('Content-Type: application/json');

try {
    $idioma = $_GET['idioma'] ?? 'pt';
    
    // Busca todos os produtos do banco
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id ASC");
    $produtos = $stmt->fetchAll();
    
    $resultado = [];
    foreach ($produtos as $produto) {
        // Usa o campo de tradução se disponível, senão usa o campo padrão
        $nome = ($idioma === 'en' && !empty($produto['nome_en'])) ? $produto['nome_en'] : $produto['nome'];
        $descricao = ($idioma === 'en' && !empty($produto['descricao_en'])) ? $produto['descricao_en'] : $produto['descricao'];
        
        $resultado[] = [
            'id' => $produto['id'],
            'nome' => $nome,
            'descricao' => $descricao,
            'mercado' => $produto['mercado'],
            'foto' => $produto['foto'] ? 'img/' . $produto['foto'] : 'img/madeira.png'
        ];
    }
    
    if (empty($resultado)) {
        // Log para depuração se não houver produtos
        // error_log("Nenhum produto encontrado no banco de dados.");
    }
    echo json_encode(['status' => 'success', 'produtos' => $resultado]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
