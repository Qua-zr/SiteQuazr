<?php
require_once 'includes/header.php';

// Obter dados dos serviços
$servicos = getServicosSite($idioma);
?>

    <!-- Serviços -->
    <section id="servicos">
        <div class="section-title animate-on-scroll">
            <h2><?php echo $idioma == 'pt' ? 'Nossos Serviços' : 'Our Services'; ?></h2>
            <p><?php echo $idioma == 'pt' ? 'Soluções tecnológicas personalizadas para o seu negócio' : 'Customized technological solutions for your business'; ?></p>
        </div>
        <div class="services-grid">
            <?php foreach ($servicos as $servico): ?>
            <div class="service-card animate-on-scroll">
                <div class="service-icon">
                    <i class="<?php echo htmlspecialchars($servico['icone'] ?? 'fas fa-cogs'); ?>"></i>
                </div>
                <h3><?php echo htmlspecialchars($servico['titulo']); ?></h3>
                <p><?php echo htmlspecialchars($servico['descricao']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>