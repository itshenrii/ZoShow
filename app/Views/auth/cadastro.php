<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION['mensagem'])) {
    echo '<p style="color: green; text-align: center;">' . $_SESSION['mensagem'] . '</p>';
    unset($_SESSION['mensagem']);
}

if (isset($_SESSION['erro'])) {
    echo '<p style="color: red; text-align: center;">' . $_SESSION['erro'] . '</p>';
    unset($_SESSION['erro']);
}
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>ZoShow - Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/cadastro.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://i.imgur.com/a9sjbK1.png" alt="ZoShow Logo">
        </div>

        <p class="slogan">
            Crie sua Conta ZoShow, <span class="gratuit">é grátis!</span>
        </p>


        <form action="/public/cadastro" method="post">
            <div class="form-group">
                <label class="form-label">Nome completo</label>
                <input type="text" name="nome" class="form-input" placeholder="Informe seu nome completo" required>
            </div>

            <div class="form-group">
                <label class="form-label">Informe o seu e-mail</label>
                <input type="email" name="email" class="form-input" placeholder="Ex: email@outlook, @yahoo, etc." required>
            </div>

            <div class="form-group">
                <label class="form-label">Data de nascimento</label>
                <input type="date" name="nascimento" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Defina sua senha</label>
                <input type="password" name="senha" class="form-input" placeholder="Defina sua senha" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirme sua senha</label>
                <input type="password" name="confirmar" class="form-input" placeholder="Confirme sua senha" required>
            </div>

            <button type="submit" class="btn-continue">Cadastrar</button>
        </form>
        <p class="signup-link">
            Já tem conta? <a href="/public/login">Faça Login</a>
        </p>
    </div>
</body>

</html>