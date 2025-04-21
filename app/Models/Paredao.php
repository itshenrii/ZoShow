<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBB - Voto da torcida</title>
    <link rel="stylesheet" href="/public/assets/css/paredao.css">
    <?php require_once BASE_PATH . "/app/Views/site/layouts/header.php"; ?>
</head>
<body>

    <div class="content">
        <h1 class="main-title">Voto da torcida: quem você quer eliminar do BBB 25?</h1>
        <p class="subtitle" style="font-family: 'Roboto', sans-serif;">Vote para definir quem deve ser eliminado do Big Brother Brasil 2025</p>
        
        <div class="participant-container">
            <div class="participant-card" data-participant="Diego Hypolito">
                <div class="participant-name">Diego Hypolito</div>
                <div class="image-container">
                    <img class="participant-image" src="https://i.imgur.com/v8fqk3T.jpeg" alt="Diego Hypolito">
                    <div class="zoom-button">
                        <img class="zoom-icon-img" src="https://i.imgur.com/9YXErYJ.png" alt="Zoom">
                    </div>
                </div>
            </div>
            
            <div class="participant-card" data-participant="Renata">
                <div class="participant-name">Renata</div>
                <div class="image-container">
                    <img class="participant-image" src="https://i.imgur.com/FXQtBW8.jpeg" alt="Renata">
                    <div class="zoom-button">
                        <img class="zoom-icon-img" src="https://i.imgur.com/9YXErYJ.png" alt="Zoom">
                    </div>
                </div>
            </div>
            
            <div class="participant-card" data-participant="Vitória Strada">
                <div class="participant-name">Vitória Strada</div>
                <div class="image-container">
                    <img class="participant-image" src="https://i.imgur.com/jtT2aMz.jpeg" alt="Vitória Strada">
                    <div class="zoom-button">
                        <img class="zoom-icon-img" src="https://i.imgur.com/9YXErYJ.png" alt="Zoom">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Frame de confirmação -->
        <div id="confirmationFrame" class="confirmation-frame">
            <div class="confirmation-content">
                <div class="confirmation-text">Você selecionou a opção <span id="selectedName" class="selected-name"></span>. Confirme que você é humano através do captcha para validar seu voto.</div>
                
                <!-- Container do reCAPTCHA -->
                <div id="recaptchaContainer" class="recaptcha-container">
                    <div id="recaptcha" class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="onCaptchaSuccess"></div>
                </div>
                
                <!-- Container de processamento - inicialmente oculto -->
                <div id="processingContainer" class="processing-container">
                    <div class="loader"></div>
                    <div class="processing-text">Processando seu voto</div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
        
        <div class="continue-text">CONTINUE VOTANDO:</div>
        
        <div class="vote-button-container">
            <div>
                <div class="vote-button-text">Voto único</div>
                <div class="vote-button-subtext">Ainda não usou seu 'Voto único'? Vote agora!</div>
            </div>
            <img class="vote-mascot" src="https://i.imgur.com/EzKMNWY.png" alt="Mascote de votação">
        </div>
    </div>

    <!-- Rodapé -->
    <div class="footer">
        <div class="footer-top">
            <div class="footer-logo">gshow</div>
            <div class="footer-brand">
                <div class="footer-brand-name">EndemolShineGroup</div>
                <div class="footer-brand-subtext">Endemol Shine Group B.V.</div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copyright">© Copyright 2000-2025 Globo Comunicação e Participações S.A.</div>
            <div class="footer-links">
                <a href="#" class="footer-link">princípios editoriais</a>
                <a href="#" class="footer-link">política de privacidade</a>
                <a href="#" class="footer-link">minha conta</a>
                <a href="#" class="footer-link">anuncie conosco</a>
            </div>
        </div>
    </div>

    <!-- Script do Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona todos os cards de participantes
            const participantCards = document.querySelectorAll('.participant-card');
            const confirmationFrame = document.getElementById('confirmationFrame');
            const selectedNameSpan = document.getElementById('selectedName');
            const recaptchaContainer = document.getElementById('recaptchaContainer');
            const processingContainer = document.getElementById('processingContainer');
            let selectedParticipant = null;
            
            // Adiciona evento de clique para cada card
            participantCards.forEach(card => {
                card.addEventListener('click', function() {
                    const participantName = this.getAttribute('data-participant');
                    
                    // Se já houver um participante selecionado, remove a seleção
                    if (selectedParticipant) {
                        selectedParticipant.classList.remove('selected');
                    }
                    
                    // Seleciona o card clicado
                    this.classList.add('selected');
                    selectedParticipant = this;
                    
                    // Atualiza o nome do participante selecionado e exibe o frame
                    selectedNameSpan.textContent = participantName;
                    confirmationFrame.style.display = 'block';
                    
                    // Garante que o container de processamento esteja oculto e o reCAPTCHA visível
                    processingContainer.style.display = 'none';
                    recaptchaContainer.style.display = 'flex';
                    
                    // Scroll automático para posicionar o captcha com um ajuste para baixo
                    setTimeout(() => {
                        const topPos = confirmationFrame.offsetTop - 80; // Ajustado para melhor visualização
                        window.scrollTo({
                            top: topPos,
                            behavior: 'smooth'
                        });
                    }, 100);
                    
                    // Reset do reCAPTCHA se necessário
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }
                });
            });
            
            // Função de callback para quando o captcha é validado com sucesso
            window.onCaptchaSuccess = function() {
                // Oculta o reCAPTCHA
                recaptchaContainer.style.display = 'none';
                
                // Mostra a animação de processamento
                processingContainer.style.display = 'flex';
                
                // Após 800ms (menos de 1 segundo como pedido), oculta a mensagem de processamento
                setTimeout(() => {
                    processingContainer.style.display = 'none';
                    // Aqui você pode adicionar o próximo passo após o processamento
                    
                    // Por enquanto vamos apenas esconder o frame de confirmação após mais 200ms
                    setTimeout(() => {
                        confirmationFrame.style.display = 'none';
                    }, 200);
                }, 800);
            };
        });
    </script>
</body>
</html>