<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
verificarLogin();

$mensagem = '';
$erro = '';

// Adicionar serviço
if ($_POST && isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $icone = trim($_POST['icone']);
    $idioma = trim($_POST['idioma']);
    
    if (empty($titulo) || empty($descricao) || empty($idioma)) {
        $erro = 'Todos os campos são obrigatórios!';
    } else {
        if (adicionarServico($titulo, $descricao, $icone, $idioma)) {
            $mensagem = 'Serviço adicionado com sucesso!';
        } else {
            $erro = 'Erro ao adicionar serviço. Tente novamente.';
        }
    }
}

// Excluir serviço
if (isset($_GET['excluir'])) {
    $id = (int)$_GET['excluir'];
    if (excluirServico($id)) {
        $mensagem = 'Serviço excluído com sucesso!';
    } else {
        $erro = 'Erro ao excluir serviço. Tente novamente.';
    }
}

// Listar serviços
$servicos = getServicos();
$servicos_en = getServicos('en');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - TechNova Admin</title>
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

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-table th,
        .admin-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-table th {
            background: rgba(142, 54, 255, 0.2);
            color: white;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .admin-table tr:hover {
            background: rgba(142, 54, 255, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit {
            background: #ffc107;
            color: #212529;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            opacity: 0.8;
            transform: translateY(-2px);
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
            <li><a href="servicos.php" class="active">Serviços</a></li>
            <li><a href="localizacao.php">Localização</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </nav>
    
    <div class="admin-content">
        <div class="section-title">
            <h2>Gerenciar Serviços</h2>
            <p>Adicione, edite ou remova serviços oferecidos</p>
        </div>
        
        <?php if ($mensagem): ?>
            <div class="alert alert-success"><?php echo $mensagem; ?></div>
        <?php endif; ?>
        
        <?php if ($erro): ?>
            <div class="alert alert-error"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <div class="admin-form">
            <h3>Adicionar Serviço</h3>
            <form method="POST">
                <input type="hidden" name="acao" value="adicionar">
                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo" required>
                </div>
                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="descricao" required></textarea>
                </div>
                <div class="form-group">
                    <label>Ícone (classe Font Awesome):</label>
                    <input type="text" name="icone" placeholder="ex: fas fa-laptop-code">
                </div>
                <div class="form-group">
                    <label>Idioma:</label>
                    <select name="idioma">
                        <option value="pt">Português</option>
                        <option value="en">Inglês</option>
                    </select>
                </div>
                <button type="submit" class="cta-button">Adicionar Serviço</button>
            </form>
        </div>
        
        <h3>Serviços em Português</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ícone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicos as $servico): ?>
                <tr>
                    <td><?php echo htmlspecialchars($servico['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($servico['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($servico['icone']); ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="?excluir=<?php echo $servico['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3 style="margin-top: 2rem;">Serviços em Inglês</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ícone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicos_en as $servico): ?>
                <tr>
                    <td><?php echo htmlspecialchars($servico['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($servico['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($servico['icone']); ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="?excluir=<?php echo $servico['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>