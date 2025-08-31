<?php
require_once 'includes/header.php';

// Obter dados para a página inicial
$localizacao = getLocalizacaoSite($idioma);
$contato = getContatoSite($idioma);
?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1><?php echo $idioma == 'pt' ? 'Inovação que Transforma Negócios' : 'Innovation that Transforms Businesses'; ?></h1>
            <p><?php echo $idioma == 'pt' ? 'Somos uma empresa de tecnologia especializada em soluções digitais que impulsionam o crescimento e a transformação digital de empresas em todo o mundo.' : 'We are a technology company specialized in digital solutions that drive growth and digital transformation of companies worldwide.'; ?></p>
            <a href="contato.php<?php echo $idioma == 'en' ? '?lang=en' : ''; ?>" class="cta-button"><?php echo $idioma == 'pt' ? 'Comece Agora' : 'Get Started'; ?></a>
        </div>
        <div class="hero-image">
            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                <circle cx="250" cy="250" r="200" fill="none" stroke="url(#gradient)" stroke-width="20" stroke-dasharray="10,10"/>
                <circle cx="250" cy="250" r="150" fill="none" stroke="rgba(142, 54, 255, 0.3)" stroke-width="10"/>
                <circle cx="250" cy="250" r="100" fill="none" stroke="rgba(255, 255, 255, 0.1)" stroke-width="5"/>
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#8Ec6FF"/>
                        <stop offset="100%" stop-color="#8E36FF"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>

    <!-- Sobre -->
    <section id="sobre">
        <div class="section-title animate-on-scroll">
            <h2><?php echo $idioma == 'pt' ? 'Sobre Nossa Empresa' : 'About Our Company'; ?></h2>
            <p><?php echo $idioma == 'pt' ? 'Conheça nossa jornada e os valores que nos guiam' : 'Discover our journey and the values that guide us'; ?></p>
        </div>
        <div class="about-content">
            <div class="about-card animate-on-scroll">
                <i class="fas fa-history"></i>
                <h3><?php echo $idioma == 'pt' ? 'Nossa História' : 'Our History'; ?></h3>
                <p><?php echo $idioma == 'pt' ? 'Fundada em 2020 por um grupo de entusiastas da tecnologia, crescemos de uma pequena startup para uma referência no mercado de desenvolvimento de software.' : 'Founded in 2020 by a group of technology enthusiasts, we grew from a small startup to a reference in the software development market.'; ?></p>
            </div>
            <div class="about-card animate-on-scroll">
                <i class="fas fa-eye"></i>
                <h3><?php echo $idioma == 'pt' ? 'Visão' : 'Vision'; ?></h3>
                <p><?php echo $idioma == 'pt' ? 'Ser reconhecida internacionalmente como uma empresa que entrega soluções tecnológicas de excelência, contribuindo para a transformação digital de empresas em todo o mundo.' : 'To be internationally recognized as a company that delivers excellent technological solutions, contributing to the digital transformation of companies worldwide.'; ?></p>
            </div>
            <div class="about-card animate-on-scroll">
                <i class="fas fa-bullseye"></i>
                <h3><?php echo $idioma == 'pt' ? 'Missão' : 'Mission'; ?></h3>
                <p><?php echo $idioma == 'pt' ? 'Transformar desafios em oportunidades através da tecnologia, desenvolvendo soluções inovadoras que agreguem valor aos nossos clientes e à sociedade.' : 'To transform challenges into opportunities through technology, developing innovative solutions that add value to our customers and society.'; ?></p>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>