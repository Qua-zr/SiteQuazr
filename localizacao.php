<?php
require_once 'includes/header.php';

// Obter dados de localização
$localizacao = getLocalizacaoSite($idioma);
?>

    <!-- Localização -->
    <section id="localizacao" style="background: rgba(0, 0, 0, 0.1);">
        <div class="section-title animate-on-scroll">
            <h2><?php echo $idioma == 'pt' ? 'Nossa Localização' : 'Our Location'; ?></h2>
            <p><?php echo $idioma == 'pt' ? 'Onde estamos e como nos encontrar' : 'Where we are and how to find us'; ?></p>
        </div>
        <div class="location-content">
            <div class="location-info animate-on-scroll">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Endereço' : 'Address'; ?></h3>
                        <p><?php echo htmlspecialchars($localizacao['endereco'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Telefone' : 'Phone'; ?></h3>
                        <p><?php echo htmlspecialchars($localizacao['telefone'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Email' : 'Email'; ?></h3>
                        <p><?php echo htmlspecialchars($localizacao['email'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Horário de Funcionamento' : 'Business Hours'; ?></h3>
                        <p><?php echo htmlspecialchars($localizacao['horario_funcionamento'] ?? ''); ?></p>
                    </div>
                </div>
            </div>
            <div class="map-container animate-on-scroll">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt fa-3x"></i>
                    <p style="margin-left: 1rem;"><?php echo $idioma == 'pt' ? 'Mapa Interativo' : 'Interactive Map'; ?></p>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>