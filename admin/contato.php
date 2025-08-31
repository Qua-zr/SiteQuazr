<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
verificarLogin();

$mensagem = '';
$erro = '';

// Atualizar contato
if ($_POST && isset($_POST['acao']) && $_POST['acao'] == 'atualizar') {
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $horario = trim($_POST['horario']);
    $idioma = trim($_POST['idioma']);
    
    if (empty($telefone) || empty($email) || empty($horario) || empty($idioma)) {
        $erro = 'Todos os campos são obrigatórios!';
    } else {
        if (atualizarContato($telefone, $email, $horario, $idioma)) {
            $mensagem = 'Informações de contato atualizadas com sucesso!';
        } else {
            $erro = 'Erro ao atualizar informações. Tente novamente.';
        }
    }
}

// Obter dados atuais
$contato_pt = getContato('pt');
$contato_en = getContato('en');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - TechNova Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #14213D;
            --secondary: #8Ec6FF;
            --accent: #E5E5E5;
            --light: #F8F9FA;
            --dark: #0A1128;
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f1a30 0%, #1a1a2e 100%);
            color: var(--accent);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: rgba(20, 33, 61, 0.8);
            border-bottom: 1px solid rgba(142, 54, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .admin-logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 900;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .admin-nav {
            background: rgba(20, 33, 61, 0.8);
            border-radius: 15px;
            padding: 1rem;
            margin: 2rem 5%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-nav ul {
            display: flex;
            list-style: none;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .admin-nav a {
            color: var(--accent);
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            transition: var(--transition);
            font-weight: 500;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: var(--secondary);
            color: white;
        }

        .admin-content {
            padding: 0 5% 3rem;
        }

        .section-title {
            margin-bottom: 2rem;
        }

        .section-title h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .admin-form {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
            color: white;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(142, 54, 255, 0.3);
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(142, 54, 255, 0.4);
        }

        .logout-btn {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(220, 53, 69, 0.3);
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="admin-logo">Tech<span>Nova</span> Admin</div>
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
    </header>
    
    <nav class="admin-nav">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="equipe.php">Equipe</a></li>
            <li><a href="servicos.php">Serviços</a></li>
            <li><a href="localizacao.php">Localização</a></li>
            <li><a href="contato.php" class="active">Contato</a></li>
        </ul>
    </nav>
    
    <div class="admin-content">
        <div class="section-title">
            <h2>Gerenciar Informações de Contato</h2>
            <p>Edite as informações de contato da empresa</p>
        </div>
        
        <?php if ($mensagem): ?>
            <div class="alert alert-success"><?php echo $mensagem; ?></div>
        <?php endif; ?>
        
        <?php if ($erro): ?>
            <div class="alert alert-error"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <div class="admin-form">
            <h3>Editar Informações de Contato (Português)</h3>
            <form method="POST">
                <input type="hidden" name="acao" value="atualizar">
                <input type="hidden" name="idioma" value="pt">
                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($contato_pt['telefone'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($contato_pt['email'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Horário de Funcionamento:</label>
                    <input type="text" name="horario" value="<?php echo htmlspecialchars($contato_pt['horario_funcionamento'] ?? ''); ?>" required>
                </div>
                <button type="submit" class="cta-button">Atualizar Contato</button>
            </form>
        </div>
        
        <div class="admin-form">
            <h3>Editar Informações de Contato (Inglês)</h3>
            <form method="POST">
                <input type="hidden" name="acao" value="atualizar">
                <input type="hidden" name="idioma" value="en">
                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($contato_en['telefone'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($contato_en['email'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Horário de Funcionamento:</label>
                    <input type="text" name="horario" value="<?php echo htmlspecialchars($contato_en['horario_funcionamento'] ?? ''); ?>" required>
                </div>
                <button type="submit" class="cta-button">Atualizar Contato</button>
            </form>
        </div>
    </div>
</body>
</html>