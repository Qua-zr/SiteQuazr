<?php
require_once 'conexao.php';

function getEquipe($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM equipe WHERE idioma = ? ORDER BY id");
    $stmt->execute([$idioma]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServicos($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM servicos WHERE idioma = ? ORDER BY id");
    $stmt->execute([$idioma]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLocalizacao($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM localizacao WHERE idioma = ? LIMIT 1");
    $stmt->execute([$idioma]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getContato($idioma = 'pt') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM contato WHERE idioma = ? LIMIT 1");
    $stmt->execute([$idioma]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function adicionarMembroEquipe($nome, $cargo, $descricao, $idioma) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO equipe (nome, cargo, descricao, idioma) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nome, $cargo, $descricao, $idioma]);
}

function adicionarServico($titulo, $descricao, $icone, $idioma) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO servicos (titulo, descricao, icone, idioma) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$titulo, $descricao, $icone, $idioma]);
}

function atualizarLocalizacao($endereco, $telefone, $email, $horario, $idioma) {
    global $pdo;
    // Verificar se já existe registro para este idioma
    $stmt = $pdo->prepare("SELECT id FROM localizacao WHERE idioma = ?");
    $stmt->execute([$idioma]);
    
    if ($stmt->fetch()) {
        // Atualizar
        $stmt = $pdo->prepare("UPDATE localizacao SET endereco = ?, telefone = ?, email = ?, horario_funcionamento = ? WHERE idioma = ?");
        return $stmt->execute([$endereco, $telefone, $email, $horario, $idioma]);
    } else {
        // Inserir
        $stmt = $pdo->prepare("INSERT INTO localizacao (endereco, telefone, email, horario_funcionamento, idioma) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$endereco, $telefone, $email, $horario, $idioma]);
    }
}

function atualizarContato($telefone, $email, $horario, $idioma) {
    global $pdo;
    // Verificar se já existe registro para este idioma
    $stmt = $pdo->prepare("SELECT id FROM contato WHERE idioma = ?");
    $stmt->execute([$idioma]);
    
    if ($stmt->fetch()) {
        // Atualizar
        $stmt = $pdo->prepare("UPDATE contato SET telefone = ?, email = ?, horario_funcionamento = ? WHERE idioma = ?");
        return $stmt->execute([$telefone, $email, $horario, $idioma]);
    } else {
        // Inserir
        $stmt = $pdo->prepare("INSERT INTO contato (telefone, email, horario_funcionamento, idioma) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$telefone, $email, $horario, $idioma]);
    }
}

function excluirMembroEquipe($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM equipe WHERE id = ?");
    return $stmt->execute([$id]);
}

function excluirServico($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
    return $stmt->execute([$id]);
}
?>