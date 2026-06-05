<?php
/**
 * Arquivo: enviar_email.php
 * Certifique-se de que a pasta 'phpmailer/' está no mesmo diretório deste arquivo.
 */

require_once 'config.php';

// 1. IMPORTA OS NAMESPACES
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// 2. CARREGA OS ARQUIVOS MANUALMENTE
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

/**
 * Função para enviar e-mail do orçamento usando SMTP Autenticado da KingHost
 */
function enviarEmailOrcamento($nome, $telefone, $email, $produto, $quantidade, $cidade, $mensagem) {
    global $pdo;
    
    try {
        // 3. BUSCA O E-MAIL DESTINATÁRIO NO BANCO DE DADOS
        $stmt = $pdo->query("SELECT valor FROM configuracoes WHERE chave = 'email_orcamentos' LIMIT 1");
        $config = $stmt->fetch();
        
        if (!$config || empty($config['valor'])) {
            throw new Exception("Configuração 'email_orcamentos' não foi encontrada na tabela 'configuracoes'.");
        }
        
        $emailDestino = $config['valor'];
        
        // 4. HIGIENIZAÇÃO DOS DADOS
        $nome          = htmlspecialchars(trim($nome));
        $telefone      = htmlspecialchars(trim($telefone));
        $emailCliente  = filter_var(trim($email), FILTER_VALIDATE_EMAIL) ? trim($email) : '';
        $produto       = htmlspecialchars(trim($produto));
        $quantidade    = htmlspecialchars(trim($quantidade));
        $cidade        = htmlspecialchars(trim($cidade));
        
        // 5. CONFIGURAÇÃO DO PHPMAILER (Padrão KingHost homologado no teste)
        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host       = 'smtp.kinghost.net';        
        $mail->SMTPAuth   = true;                               
        $mail->Username   = 'orcamento@florestalpinus.com';     
        $mail->Password   = 'Emailadmin123!';                 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
        $mail->Port       = 587;                              
        $mail->CharSet    = 'UTF-8';
        
        // 6. REMETENTE E DESTINATÁRIO
        $mail->setFrom('orcamento@florestalpinus.com', 'Florestal Pinus');
        $mail->addAddress($emailDestino);                     
        
        if (!empty($emailCliente)) {
            $mail->addReplyTo($emailCliente, $nome);              
        }
        
        // 7. CONTEÚDO DO E-MAIL
        $mail->isHTML(true);
        $mail->Subject = 'Novo Orçamento - Florestal Pinus';
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f5f5f5; border-radius: 8px; }
                .header { background: #24412D; color: white; padding: 25px; border-radius: 5px 5px 0 0; text-align: center; }
                .header h1 { margin: 0; font-size: 22px; }
                .content { background: white; padding: 25px; border-radius: 0 0 5px 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
                .field { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
                .label { font-weight: bold; color: #24412D; display: inline-block; width: 150px; }
                .message-box { background: #f9f9f9; padding: 15px; border-left: 4px solid #24412D; margin-top: 5px; border-radius: 4px; }
                .footer { text-align: center; font-size: 11px; color: #777; margin-top: 20px; }
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
                        <span class='label'>E-mail do Cliente:</span> " . ($emailCliente ?: 'Não informado') . "
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
                    <div class='field' style='border-bottom: none;'>
                        <span class='label'>Mensagem/Observações:</span>
                        <div class='message-box'>" . nl2br(htmlspecialchars($mensagem)) . "</div>
                    </div>
                </div>
                <div class='footer'>
                    <p>Este é um e-mail automático gerado pelo sistema Florestal Pinus. Por favor, não responda diretamente a este remetente.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        // Em vez de dar echo, repassa o erro para o processador tratar no JSON
        throw new Exception("Erro no envio do e-mail: " . $mail->ErrorInfo);
    }
}
?>