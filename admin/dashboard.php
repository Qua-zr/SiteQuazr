<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
verificarLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TechNova Admin</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .stat-card {
            background: rgba(142, 54, 255, 0.2);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }

        .stat-card i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }

        .stat-card h3 {
            font-size: 1.5rem;
            margin: 0.5rem 0;
        }

        @media (max-width: 768px) {
            .admin-nav ul {
                flex-direction: column;
            }
            
            .admin-nav a {
                text-align: center;
            }
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
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="equipe.php">Equipe</a></li>
            <li><a href="servicos.php">Serviços</a></li>
            <li><a href="localizacao.php">Localização</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </nav>
    
    <div class="admin-content">
        <div class="section-title">
            <h2>Dashboard</h2>
            <p>Bem-vindo, <?php echo getUsuarioNome(); ?>!</p>
        </div>
        
        <div class="admin-form">
            <h3>Estatísticas</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3><?php echo count(getEquipe()); ?></h3>
                    <p>Membros da Equipe</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-cogs"></i>
                    <h3><?php echo count(getServicos()); ?></h3>
                    <p>Serviços</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3><?php echo getLocalizacao() ? 1 : 0; ?></h3>
                    <p>Localizações</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-envelope"></i>
                    <h3><?php echo getContato() ? 1 : 0; ?></h3>
                    <p>Contatos</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>