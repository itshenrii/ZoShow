<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = '<p class="mensagem sucesso">' . $_SESSION['mensagem'] . '</p>';
    unset($_SESSION['mensagem']);
}

if (isset($_SESSION['erro'])) {
    $mensagem = '<p class="mensagem erro">' . $_SESSION['erro'] . '</p>';
    unset($_SESSION['erro']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZoShow - Login</title>
    <link rel="stylesheet" href="/public/assets/css/login.css">

</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://i.imgur.com/a9sjbK1.png" alt="ZoShow Logo">
        </div>

        <p class="slogan">
            Uma só conta para todos<br>
            os produtos ZoShow. <span class="gratuit">É grátis!</span>
        </p>

        <form method="post" action="/public/login">
            <?= $mensagem ?>

            <div class="form-group">
                <label class="form-label">Informe o seu e-mail</label>
                <input type="email" name="email" class="form-input" placeholder="Ex: email@outlook, @yahoo, etc." required>
            </div>

            <div class="form-group">
                <label class="form-label">Coloque sua senha</label>
                <input type="password" name="senha" class="form-input" placeholder="sua senha" required>
            </div>

            <button type="submit" class="btn-continue">Continuar</button>
        </form>

        <p class="signup-link">
            Não tem conta? <a href="/public/cadastro">Criar conta grátis</a>
        </p>
    </div>
</body>

</html>