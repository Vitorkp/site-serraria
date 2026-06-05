<?php
require_once 'config.php';

// 1. IMPORTA OS NAMESPACES (Obrigatório, deixa no topo do arquivo)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// 2. CARREGA OS ARQUIVOS MANUALMENTE (Já que não usa Composer)
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

/**
 * Função para enviar e-mail do orçamento usando SMTP Autenticado
 */
function enviarEmailOrcamento($nome, $telefone, $email, $produto, $quantidade, $cidade, $mensagem) {
    global $pdo;
    
    try {
        // Busca o e-mail configurado no admin
        $stmt = $pdo->query("SELECT valor FROM configuracoes WHERE chave = 'email_orcamentos' LIMIT 1");
        $config = $stmt->fetch();
        
        if (!$config || empty($config['valor'])) {
            return false; 
        }
        
        $emailDestino = $config['valor'];
        
        // Higienização dos dados
        $nome = htmlspecialchars($nome);
        $telefone = htmlspecialchars($telefone);
        $emailCliente = htmlspecialchars($email);
        $produto = htmlspecialchars($produto);
        $quantidade = htmlspecialchars($quantidade);
        $cidade = htmlspecialchars($cidade);
        
        // Instancia o PHPMailer
        $mail = new PHPMailer(true);
        
        // --- CONFIGURAÇÕES DO SERVIDOR SMTP DA KINGHOST ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.florestalpinus.com';        // Confirme se é este o host no painel da KingHost
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'noreply@florestalpinus.com';     // Seu e-mail completo
        $mail->Password   = 'SUA_SENHA_AQUI';                 // A senha REAL deste e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // TLS ativo
        $mail->Port       = 587;                              // Porta padrão 587
        $mail->CharSet    = 'UTF-8';
        
        // --- REMETENTE E DESTINATÁRIO ---
        $mail->setFrom('noreply@florestalpinus.com', 'Florestal Pinus');
        $mail->addAddress($emailDestino);                     
        $mail->addReplyTo($emailCliente, $nome);              
        
        // --- CONTEÚDO DO E-MAIL ---
        $mail->isHTML(true);
        $mail->Subject = 'Novo Orçamento - Florestal Pinus';
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
                .header { background: #24412D; color: white; padding: 20px; border-radius: 5px 5px 0 0; text-align: center; }
                .content { background: white; padding: 20px; }
                .field { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
                .label { font-weight: bold; color: #24412D; }
                .footer { background: #f0f0f0; padding: 15px; text-align: center; font-size: 12px; color: #666; border-radius: 0 0 5px 5px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Novo Orçamento Recebido</h1>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='label'>Nome:</span> {$nome}
                    </div>
                    <div class='field'>
                        <span class='label'>Telefone/WhatsApp:</span> {$telefone}
                    </div>
                    <div class='field'>
                        <span class='label'>E-mail:</span> {$emailCliente}
                    </div>
                    <div class='field'>
                        <span class='label'>Produto:</span> {$produto}
                    </div>
                    <div class='field'>
                        <span class='label'>Quantidade:</span> {$quantidade}
                    </div>
                    <div class='field'>
                        <span class='label'>Cidade:</span> {$cidade}
                    </div>
                    <div class='field'>
                        <span class='label'>Mensagem/Observações:</span>
                        <p>" . nl2br(htmlspecialchars($mensagem)) . "</p>
                    </div>
                </div>
                <div class='footer'>
                    <p>Este é um e-mail automático do sistema Florestal Pinus. Por favor, não responda.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        // Se der erro, descomente a linha abaixo para ver o que o servidor da Kinghost respondeu:
        // echo "Erro no envio: {$mail->ErrorInfo}";
        return false;
    }
}
?>