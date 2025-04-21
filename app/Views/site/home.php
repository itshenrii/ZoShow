<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBB - Gshow</title>
    <link rel="stylesheet" href="/public/assets/css/layouts.css">
</head>

<?php require_once BASE_PATH . "/app/Views/site/layouts/header.php"; ?>

<body class="bbb-body">
    <section class="bbb-hero">
        <div class="bbb-container">
            <h1 class="bbb-hero-title">BBB25 - O Brasil te vê</h1>
            <p class="bbb-hero-text">Acompanhe tudo que acontece no reality mais assistido do Brasil!</p>
            <a href="#" class="bbb-button">Vote no Paredão</a>
        </div>
    </section>

    <section class="bbb-highlights">
        <div class="bbb-container">
            <h2 class="bbb-section-title">Destaques</h2>
            <div class="bbb-card-grid">
                <div class="bbb-card">
                    <img src="/api/placeholder/400/320" alt="Prova do líder" class="bbb-card-img">
                    <div class="bbb-card-content">
                        <h3 class="bbb-card-title">Saiba quem venceu a prova do líder</h3>
                        <p class="bbb-card-text">Após mais de 8 horas de resistência, participante conquista a liderança da semana.</p>
                        <a href="#" class="bbb-card-link">Leia mais</a>
                    </div>
                </div>
                <div class="bbb-card">
                    <img src="/api/placeholder/400/320" alt="Formação do paredão" class="bbb-card-img">
                    <div class="bbb-card-content">
                        <h3 class="bbb-card-title">Formação do paredão teve briga generalizada</h3>
                        <p class="bbb-card-text">Discussão acalorada marcou a noite de domingo na formação do paredão triplo.</p>
                        <a href="#" class="bbb-card-link">Leia mais</a>
                    </div>
                </div>
                <div class="bbb-card">
                    <img src="/api/placeholder/400/320" alt="Festa" class="bbb-card-img">
                    <div class="bbb-card-content">
                        <h3 class="bbb-card-title">Festa agita a casa com show especial</h3>
                        <p class="bbb-card-text">Brothers e sisters curtiram apresentação exclusiva e muita diversão madrugada adentro.</p>
                        <a href="#" class="bbb-card-link">Leia mais</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bbb-participants">
        <div class="bbb-container">
            <h2 class="bbb-section-title">Participantes</h2>
            <div class="bbb-participant-grid">
                <div class="bbb-participant">
                    <img src="/api/placeholder/120/120" alt="Participante 1" class="bbb-participant-img">
                    <h3 class="bbb-participant-name">Ana</h3>
                    <p class="bbb-participant-info">28 anos, SP</p>
                </div>
                <div class="bbb-participant">
                    <img src="/api/placeholder/120/120" alt="Participante 2" class="bbb-participant-img">
                    <h3 class="bbb-participant-name">Bruno</h3>
                    <p class="bbb-participant-info">32 anos, RJ</p>
                </div>
                <div class="bbb-participant">
                    <img src="/api/placeholder/120/120" alt="Participante 3" class="bbb-participant-img">
                    <h3 class="bbb-participant-name">Carla</h3>
                    <p class="bbb-participant-info">26 anos, MG</p>
                </div>
                <div class="bbb-participant">
                    <img src="/api/placeholder/120/120" alt="Participante 4" class="bbb-participant-img">
                    <h3 class="bbb-participant-name">Diogo</h3>
                    <p class="bbb-participant-info">30 anos, RS</p>
                </div>
                <div class="bbb-participant">
                    <img src="/api/placeholder/120/120" alt="Participante 5" class="bbb-participant-img">
                    <h3 class="bbb-participant-name">Elisa</h3>
                    <p class="bbb-participant-info">27 anos, BA</p>
                </div>
                <div class="bbb-participant">
                    <img src="/api/placeholder/120/120" alt="Participante 6" class="bbb-participant-img">
                    <h3 class="bbb-participant-name">Felipe</h3>
                    <p class="bbb-participant-info">33 anos, PE</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bbb-updates">
        <div class="bbb-container">
            <h2 class="bbb-section-title">Últimas Atualizações</h2>
            <ul class="bbb-update-list">
                <li class="bbb-update-item">
                    <h3 class="bbb-update-title">Brothers fazem dinâmica especial na sala</h3>
                    <p class="bbb-update-time">Hoje às 14:30</p>
                    <p>Dinâmica proposta pelo Big Boss movimentou a tarde dos participantes com revelações surpreendentes.</p>
                </li>
                <li class="bbb-update-item">
                    <h3 class="bbb-update-title">Participantes recebem recado misterioso</h3>
                    <p class="bbb-update-time">Hoje às 12:15</p>
                    <p>Big Boss deixou envelope na sala com instruções para nova prova que acontecerá mais tarde.</p>
                </li>
                <li class="bbb-update-item">
                    <h3 class="bbb-update-title">Pipoca e Camarote se desentendem na cozinha</h3>
                    <p class="bbb-update-time">Hoje às 10:45</p>
                    <p>Divisão de tarefas domésticas causa nova discussão entre os grupos na casa mais vigiada do Brasil.</p>
                </li>
            </ul>
        </div>
    </section>
</body>
<?php require_once BASE_PATH . "/app/Views/site/layouts/footer.php"; ?>
</html>
