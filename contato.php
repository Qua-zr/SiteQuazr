<?php
require_once 'includes/header.php';

// Obter dados de contato
$contato = getContatoSite($idioma);

// Mensagens
$mensagem = '';
$erro = '';

// Verificar se o formulário foi enviado
if ($_POST) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem_texto = trim($_POST['mensagem']);
    
    if (empty($nome) || empty($email) || empty($mensagem_texto)) {
        $erro = $idioma == 'pt' ? 'Todos os campos são obrigatórios!' : 'All fields are required!';
    } else {
        // Em uma implementação real, você salvaria no banco ou enviaria por email
        // Por enquanto, vamos mostrar uma mensagem de sucesso
        $mensagem = $idioma == 'pt' ? 'Mensagem enviada com sucesso! Nossa equipe entrará em contato em breve.' : 'Message sent successfully! Our team will contact you soon.';
        
        // Limpar os campos
        $_POST = [];
    }
}
?>

    <!-- Contato -->
    <section id="contato">
        <div class="section-title animate-on-scroll">
            <h2><?php echo $idioma == 'pt' ? 'Entre em Contato' : 'Get in Touch'; ?></h2>
            <p><?php echo $idioma == 'pt' ? 'Estamos prontos para ajudar você' : 'We are ready to help you'; ?></p>
        </div>
        <div class="contact-container">
            <div class="contact-form animate-on-scroll">
                <?php if ($mensagem): ?>
                    <div class="alert alert-success"><?php echo $mensagem; ?></div>
                <?php endif; ?>
                
                <?php if ($erro): ?>
                    <div class="alert alert-error"><?php echo $erro; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="name"><?php echo $idioma == 'pt' ? 'Nome' : 'Name'; ?></label>
                        <input type="text" id="name" name="nome" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="message"><?php echo $idioma == 'pt' ? 'Mensagem' : 'Message'; ?></label>
                        <textarea id="message" name="mensagem" rows="5" required><?php echo htmlspecialchars($_POST['mensagem'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" class="cta-button"><?php echo $idioma == 'pt' ? 'Enviar Mensagem' : 'Send Message'; ?></button>
                </form>
            </div>
            <div class="contact-details animate-on-scroll">
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Telefone' : 'Phone'; ?></h3>
                        <p><?php echo htmlspecialchars($contato['telefone'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Email' : 'Email'; ?></h3>
                        <p><?php echo htmlspecialchars($contato['email'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Endereço' : 'Address'; ?></h3>
                        <p><?php echo htmlspecialchars($localizacao['endereco'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h3><?php echo $idioma == 'pt' ? 'Horário de Funcionamento' : 'Business Hours'; ?></h3>
                        <p><?php echo htmlspecialchars($contato['horario_funcionamento'] ?? ''); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>