<?php
session_start();
require_once 'includes/conexao.php';

$erro = '';

if ($_POST) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            header('Location: dashboard.php');
            exit();
        } else {
            $erro = 'Usuário ou senha inválidos!';
        }
    } catch(PDOException $e) {
        $erro = 'Erro ao realizar login: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechNova Admin</title>
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .login-logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--secondary), #ff6b6b);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
            color: white;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(142, 54, 255, 0.2);
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
            width: 100%;
            margin-top: 1rem;
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(142, 54, 255, 0.4);
        }

        .error-message {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: <?php echo $erro ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">Tech<span>Nova</span> Admin</div>
            <h2>Login</h2>
            <div class="error-message" id="error-message"><?php echo $erro; ?></div>
            <form method="POST">
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit" class="cta-button">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>