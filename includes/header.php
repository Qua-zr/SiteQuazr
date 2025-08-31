<?php
require_once 'includes/conexao.php';

// Funções para obter dados do banco
function getEquipeSite($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM equipe WHERE idioma = ? ORDER BY id");
    $stmt->execute([$idioma]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServicosSite($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM servicos WHERE idioma = ? ORDER BY id");
    $stmt->execute([$idioma]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLocalizacaoSite($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM localizacao WHERE idioma = ? LIMIT 1");
    $stmt->execute([$idioma]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getContatoSite($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM contato WHERE idioma = ? LIMIT 1");
    $stmt->execute([$idioma]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Determinar idioma
$idioma = isset($_GET['lang']) ? $_GET['lang'] : 'pt';
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNova | <?php echo $idioma == 'pt' ? 'Soluções Tecnológicas' : 'Technology Solutions'; ?></title>
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

        /* Animações */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            background: rgba(20, 33, 61, 0.8);
            border-bottom: 1px solid rgba(142, 54, 255, 0.2);
        }

        header.scrolled {
            padding: 1rem 5%;
            background: rgba(10, 17, 40, 0.95);
        }

        .logo {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 15px rgba(142, 54, 255, 0.3);
        }

        .logo span {
            color: var(--secondary);
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        nav a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            transition: var(--transition);
        }

        nav a:hover {
            color: var(--secondary);
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: var(--transition);
        }

        nav a:hover::after {
            width: 100%;
        }

        .language-switch {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .language-switch a {
            background: transparent;
            border: 1px solid var(--secondary);
            color: var(--accent);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            text-decoration: none;
        }

        .language-switch a.active {
            background: var(--secondary);
            color: white;
        }

        .language-switch a:hover {
            background: rgba(142, 54, 255, 0.2);
        }

        .hamburger {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--accent);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(142, 54, 255, 0.15) 0%, transparent 70%);
            top: -300px;
            right: -200px;
            z-index: -1;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 107, 107, 0.15) 0%, transparent 70%);
            bottom: -200px;
            left: -100px;
            z-index: -1;
        }

        .hero-content {
            max-width: 650px;
            animation: fadeInUp 1s ease;
        }

        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #fff, var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 550px;
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
            animation: pulse 2s infinite;
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(142, 54, 255, 0.4);
        }

        .hero-image {
            position: absolute;
            right: 5%;
            width: 45%;
            max-width: 600px;
            animation: float 4s ease-in-out infinite;
        }

        /* Seções */
        section {
            padding: 6rem 5%;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .section-title p {
            max-width: 600px;
            margin: 1.5rem auto 0;
            opacity: 0.8;
        }

        /* Sobre */
        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .about-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .about-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            border-color: rgba(142, 54, 255, 0.3);
        }

        .about-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--secondary), #ff6b6b);
        }

        .about-card i {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--secondary);
        }

        .about-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        /* Equipe */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        }

        .member-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
        }

        .team-member h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .team-member .position {
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent);
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }

        /* Serviços */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            border-color: rgba(142, 54, 255, 0.3);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        /* Localização */
        .location-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .location-info {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .info-item i {
            font-size: 1.5rem;
            color: var(--secondary);
            margin-right: 1rem;
            min-width: 30px;
        }

        .map-container {
            border-radius: 20px;
            overflow: hidden;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .map-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #14213D, #8Ec6FF);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Contato */
        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
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
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
            color: white;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(142, 54, 255, 0.2);
        }

        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
        }

        .contact-item i {
            font-size: 1.5rem;
            color: var(--secondary);
            margin-right: 1rem;
            min-width: 30px;
        }

        /* Footer */
        footer {
            background: rgba(10, 17, 40, 0.9);
            padding: 3rem 5%;
            text-align: center;
            border-top: 1px solid rgba(142, 54, 255, 0.2);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .social-footer {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .social-footer a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent);
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-footer a:hover {
            background: var(--secondary);
            transform: translateY(-5px);
        }

        .copyright {
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3rem;
            }
            
            .hero-image {
                position: relative;
                width: 100%;
                max-width: 500px;
                margin: 3rem auto 0;
                right: auto;
                animation: none;
            }
            
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 6rem;
            }
            
            .hero-content {
                margin: 0 auto;
            }
            
            .hero p {
                margin: 0 auto 2rem;
            }
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
            
            nav ul {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: rgba(10, 17, 40, 0.95);
                flex-direction: column;
                align-items: center;
                padding-top: 2rem;
                transition: var(--transition);
            }
            
            nav ul.active {
                left: 0;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            section {
                padding: 4rem 5%;
            }
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
    <!-- Header -->
    <header id="header">
        <div class="logo">Tech<span>Nova</span></div>
        <nav>
            <ul id="nav-menu">
                <li><a href="index.php<?php echo $idioma == 'en' ? '?lang=en' : ''; ?>" <?php echo ($pagina_atual == 'index.php') ? 'class="active"' : ''; ?>><?php echo $idioma == 'pt' ? 'Início' : 'Home'; ?></a></li>
                <li><a href="equipe.php<?php echo $idioma == 'en' ? '?lang=en' : ''; ?>" <?php echo ($pagina_atual == 'equipe.php') ? 'class="active"' : ''; ?>><?php echo $idioma == 'pt' ? 'Equipe' : 'Team'; ?></a></li>
                <li><a href="servicos.php<?php echo $idioma == 'en' ? '?lang=en' : ''; ?>" <?php echo ($pagina_atual == 'servicos.php') ? 'class="active"' : ''; ?>><?php echo $idioma == 'pt' ? 'Serviços' : 'Services'; ?></a></li>
                <li><a href="localizacao.php<?php echo $idioma == 'en' ? '?lang=en' : ''; ?>" <?php echo ($pagina_atual == 'localizacao.php') ? 'class="active"' : ''; ?>><?php echo $idioma == 'pt' ? 'Localização' : 'Location'; ?></a></li>
                <li><a href="contato.php<?php echo $idioma == 'en' ? '?lang=en' : ''; ?>" <?php echo ($pagina_atual == 'contato.php') ? 'class="active"' : ''; ?>><?php echo $idioma == 'pt' ? 'Contato' : 'Contact'; ?></a></li>
            </ul>
        </nav>
        <div class="language-switch">
            <a href="?lang=pt" class="<?php echo $idioma == 'pt' ? 'active' : ''; ?>">PT</a>
            <a href="?lang=en" class="<?php echo $idioma == 'en' ? 'active' : ''; ?>">EN</a>
        </div>
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </header>