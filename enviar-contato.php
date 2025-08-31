<?php
require_once 'includes/conexao.php';

$mensagem = '';
$erro = '';

if ($_POST) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem_texto = trim($_POST['mensagem']);
    
    if (empty($nome) || empty($email) || empty($mensagem_texto)) {
        $erro = 'Todos os campos são obrigatórios!';
    } else {
        // Em uma implementação real, você salvaria no banco ou enviaria por email
        // Por enquanto, vamos mostrar uma mensagem de sucesso
        $mensagem = 'Mensagem enviada com sucesso! Nossa equipe entrará em contato em breve.';
    }
}

// Redirecionar de volta para a página de contato com a mensagem
header('Location: contato.php?msg=' . urlencode($mensagem) . '&erro=' . urlencode($erro));
exit();
?>