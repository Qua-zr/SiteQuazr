<?php
session_start();

function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

function usuarioLogado() {
    return isset($_SESSION['usuario_id']);
}

function getUsuarioNome() {
    return $_SESSION['usuario_nome'] ?? '';
}

function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>