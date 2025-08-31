<?php
require_once 'includes/header.php';

// Obter dados da equipe
$membros = getEquipeSite($idioma);
?>

    <!-- Equipe -->
    <section id="equipe" style="background: rgba(0, 0, 0, 0.1);">
        <div class="section-title animate-on-scroll">
            <h2><?php echo $idioma == 'pt' ? 'Nossa Equipe' : 'Our Team'; ?></h2>
            <p><?php echo $idioma == 'pt' ? 'Profissionais apaixonados por tecnologia e inovação' : 'Professionals passionate about technology and innovation'; ?></p>
        </div>
        <div class="team-grid">
            <?php foreach ($membros as $membro): ?>
            <div class="team-member animate-on-scroll">
                <div class="member-photo">
                    <i class="fas fa-user"></i>
                </div>
                <h3><?php echo htmlspecialchars($membro['nome']); ?></h3>
                <div class="position"><?php echo htmlspecialchars($membro['cargo']); ?></div>
                <p><?php echo htmlspecialchars($membro['descricao']); ?></p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>