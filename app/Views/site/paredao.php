<!DOCTYPE html>
<html lang="pt-BR">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBB - Voto da torcida</title>
    <link rel="stylesheet" href="/public/assets/css/paredao.css">
</head>
<?php require_once BASE_PATH . "/app/Views/site/layouts/header.php"; ?>
<body>
    
    <div class="content">
        <h1 class="main-title">Enquete BBB : Quem você quer mandar para a vitrine do Seu Fifi?</h1>
        <p class="subtitle" style="font-family: 'Roboto', sans-serif;"></p>
        
        <div class="participant-container">
            <div class="participant-card" data-participant="Rafah Villar">
                <div class="participant-name">Rafah Villar</div>
                <div class="image-container">
                    <img class="participant-image" src="https://i.imgur.com/KT62pQn.jpeg" alt="Rafah Villar">
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
                    <div id="turnstile-container" class="cf-turnstile" data-sitekey="0x4AAAAAABM5CmPcp5eSwv4S" data-callback="onCaptchaSuccess"></div>
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

    <?php require_once BASE_PATH . "/app/Views/site/layouts/footer.php"; ?>

    <!-- Script do Google reCAPTCHA -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <script>

		document.addEventListener('DOMContentLoaded', function() {
			// Definindo variáveis globais que precisamos acessar em diferentes funções
			const participantCards = document.querySelectorAll('.participant-card');
			const confirmationFrame = document.getElementById('confirmationFrame');
			const selectedNameSpan = document.getElementById('selectedName');
			const recaptchaContainer = document.getElementById('recaptchaContainer');
			const processingContainer = document.getElementById('processingContainer');
			let selectedParticipant = null;
			
			// Variável para controlar se o callback já foi chamado
			window.captchaCallbackExecuted = false;
			
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
				
				// Garante que o container de processamento esteja oculto e o Turnstile visível
				processingContainer.style.display = 'none';
				recaptchaContainer.style.display = 'flex';
				
				// Scroll automático para posicionar o captcha com um ajuste para baixo
				setTimeout(() => {
				  const topPos = confirmationFrame.offsetTop - 80;
				  window.scrollTo({
					top: topPos,
					behavior: 'smooth'
				  });
				}, 100);
				
				// Reset do Turnstile se necessário
				if (typeof turnstile !== 'undefined' && turnstile.reset) {
				  turnstile.reset();
				}
			  });
			});
			
			// Adiciona evento para o botão "Votar Novamente"
			const votarButton = document.querySelector('.vote-button-container');
			if (votarButton) {
			  votarButton.addEventListener('click', function() {
				// Recarrega a página para reiniciar o processo
				location.reload();
			  });
			}
			
			// Função de callback para quando o captcha é validado com sucesso
			window.onCaptchaSuccess = function(token) {
			  console.log("Captcha validado com sucesso!", token);
			  
			  // Verifica se há um token válido e se há um participante selecionado
			  if (!token || !document.querySelector('.participant-card.selected')) {
				console.log("Token inválido ou nenhum participante selecionado");
				return;
			  }
			  
			  // Evita múltiplas execuções
			  if (window.captchaCallbackExecuted) {
				console.log("Callback já executado anteriormente");
				return;
			  }
			  
			  // Marca que o callback já foi executado
			  window.captchaCallbackExecuted = true;
			  
			  // Pega o nome do participante selecionado
			  const participantName = selectedNameSpan.textContent;
			  console.log("Processando voto para:", participantName);
			  
			  // Oculta o container do captcha
			  recaptchaContainer.style.display = 'none';
			  
			  // Mostra a animação de processamento
			  processingContainer.style.display = 'flex';
			  console.log("Container de processamento exibido");
			  
			  // IMPORTANTE: Aplica imediatamente o efeito esbranquiçado aos cards não selecionados
			  // Crie um overlay para desabilitar interação com os cards
			  const disableInteractionOverlay = document.createElement('div');
			  disableInteractionOverlay.style.position = 'fixed';
			  disableInteractionOverlay.style.top = '0';
			  disableInteractionOverlay.style.left = '0';
			  disableInteractionOverlay.style.width = '100%';
			  disableInteractionOverlay.style.height = '100%';
			  disableInteractionOverlay.style.zIndex = '990';
			  disableInteractionOverlay.style.backgroundColor = 'transparent';
			  document.body.appendChild(disableInteractionOverlay);

			  // Aplica efeito esbranquiçado aos cards não selecionados IMEDIATAMENTE
			  const allCards = document.querySelectorAll('.participant-card:not(.selected)');
			  allCards.forEach(card => {
				card.style.opacity = '0.4';
				card.style.pointerEvents = 'none'; // Desabilita interação
				card.style.transition = 'opacity 0.3s ease'; // Adiciona transição suave
			  });
			  
			  // Processo de votação usando a função exportada do módulo Firebase
			  setTimeout(() => {
				// Verifica se a função registrarVoto foi definida pelo módulo
				if (typeof window.registrarVoto === 'function') {
				  window.registrarVoto(participantName)
					.then(success => {
					  if (!success) {
						console.error("Falha ao registrar o voto para " + participantName);
					  }
					  
					  console.log("Continuando com o fluxo de confirmação");
					  
					  // Após 800ms, inicia a transição para a tela de confirmação
					  setTimeout(() => {
						processingContainer.style.display = 'none';
						
						// Cria um overlay branco para o efeito fade
						const fadeOverlay = document.createElement('div');
						fadeOverlay.style.position = 'fixed';
						fadeOverlay.style.top = '0';
						fadeOverlay.style.left = '0';
						fadeOverlay.style.width = '100%';
						fadeOverlay.style.height = '100%';
						fadeOverlay.style.backgroundColor = 'white';
						fadeOverlay.style.zIndex = '9999';
						fadeOverlay.style.opacity = '0';
						fadeOverlay.style.transition = 'opacity 0.3s ease';
						document.body.appendChild(fadeOverlay);
						
						// Força o reflow para que a transição funcione
						void fadeOverlay.offsetWidth;
						
						// Inicia o fade
						fadeOverlay.style.opacity = '1';
						
						// Inicia o scroll automático para o topo durante o fade
						const scrollToTopAnimation = () => {
						  const currentPosition = window.pageYOffset;
						  if (currentPosition > 0) {
							// Cria um efeito de animação suave
							window.scrollTo({
							  top: currentPosition - Math.max(currentPosition / 10, 20),
							  behavior: 'auto'
							});
							
							// Continue a animação enquanto o fade estiver acontecendo
							if (currentPosition > 0 && parseFloat(fadeOverlay.style.opacity) < 1) {
							  requestAnimationFrame(scrollToTopAnimation);
							}
						  }
						};
						
						// Inicia a animação de scroll
						requestAnimationFrame(scrollToTopAnimation);
						
						// Após o fade, reorganiza a página
						setTimeout(() => {
						  // Scroll imediatamente para o topo (garante que chegamos ao topo)
						  window.scrollTo({
							top: 0,
							behavior: 'auto'
						  });
						  
						  // Remove o overlay de desativação
						  if (disableInteractionOverlay) {
							disableInteractionOverlay.remove();
						  }
							
						  // Guarda referências aos elementos que vamos precisar
						  const mainTitle = document.querySelector('.main-title');
						  const subtitle = document.querySelector('.subtitle');
						  const participantContainer = document.querySelector('.participant-container');
						  const confirmationFrame = document.getElementById('confirmationFrame');
						  const content = document.querySelector('.content');
						  const continueText = document.querySelector('.continue-text');
						  const voteButtonContainer = document.querySelector('.vote-button-container');
						  
						  // Guarda informações do participante selecionado
						  const participantName = selectedNameSpan.textContent;
						  const participantImage = selectedParticipant.querySelector('.participant-image').src;
						  
						  // Remove elementos existentes
						  if (mainTitle) mainTitle.remove();
						  if (subtitle) subtitle.remove();
						  if (participantContainer) participantContainer.remove();
						  if (confirmationFrame) confirmationFrame.remove();
						  if (continueText) continueText.remove();
						  
						  // Reduzir a largura do conteúdo
						  content.style.maxWidth = '500px';
						  
						  // Container principal para o checkmark, "Seu voto" e imagem
						  const mainContainer = document.createElement('div');
						  mainContainer.style.display = 'flex';
						  mainContainer.style.justifyContent = 'space-between';
						  mainContainer.style.alignItems = 'flex-start';
						  mainContainer.style.width = '100%';
						  mainContainer.style.marginBottom = '16px';
						  
						  // Container para a parte esquerda (check, "Seu voto" e nome)
						  const leftContainer = document.createElement('div');
						  leftContainer.style.display = 'flex';
						  leftContainer.style.flexDirection = 'column';
						  
						  // Container para o checkmark e "Seu voto"
						  const checkContainer = document.createElement('div');
						  checkContainer.style.display = 'flex';
						  checkContainer.style.alignItems = 'center';
						  checkContainer.style.gap = '10px';
						  checkContainer.style.marginBottom = '10px';
						  
						  // Ícone de check verde
						  const checkIcon = document.createElement('img');
						  checkIcon.src = 'https://i.imgur.com/20oSdRq.png';
						  checkIcon.alt = 'Check';
						  checkIcon.style.width = '20px';
						  checkIcon.style.height = '20px';
						  
						  // Texto "Seu voto"
						  const seuVotoText = document.createElement('span');
						  seuVotoText.textContent = 'Seu voto';
						  seuVotoText.style.color = '#333';
						  seuVotoText.style.fontSize = '16px';
						  seuVotoText.style.fontFamily = 'Roboto, sans-serif';
						  seuVotoText.style.fontWeight = '200';
						  
						  // Adiciona os elementos ao checkContainer
						  checkContainer.appendChild(checkIcon);
						  checkContainer.appendChild(seuVotoText);
						  
						  // Nome do participante
						  const nameElement = document.createElement('h2');
						  nameElement.textContent = participantName;
						  nameElement.style.fontSize = '32px';
						  nameElement.style.fontFamily = 'Open Sans, helvetica, arial, sans-serif';
						  nameElement.style.fontWeight = '700';
						  nameElement.style.color = 'rgb(17, 17, 17)';
						  nameElement.style.lineHeight = '1.2';
						  nameElement.style.letterSpacing = '-1.5px';
						  nameElement.style.margin = '0';
						  
						  // Adiciona o checkContainer e o nameElement ao leftContainer
						  leftContainer.appendChild(checkContainer);
						  leftContainer.appendChild(nameElement);
						  
						  // Container da imagem
						  const imageContainer = document.createElement('div');
						  imageContainer.style.position = 'relative';
						  imageContainer.style.width = '90px';
						  imageContainer.style.height = '90px';
						  imageContainer.style.borderRadius = '8px';
						  imageContainer.style.overflow = 'hidden';
						  imageContainer.style.border = 'none';
						  imageContainer.style.flexShrink = '0';
						  
						  // Imagem do participante
						  const imageElement = document.createElement('img');
						  imageElement.src = participantImage;
						  imageElement.alt = participantName;
						  imageElement.style.width = '90px';
						  imageElement.style.height = '90px';
						  imageElement.style.objectFit = 'cover';
						  
						  // Botão de zoom
						  const zoomButton = document.createElement('div');
						  zoomButton.style.position = 'absolute';
						  zoomButton.style.bottom = '7px';
						  zoomButton.style.left = '7px';
						  zoomButton.style.width = '18px';
						  zoomButton.style.height = '18px';
						  zoomButton.style.display = 'flex';
						  zoomButton.style.justifyContent = 'center';
						  zoomButton.style.alignItems = 'center';
						  zoomButton.style.zIndex = '10';
						  zoomButton.style.cursor = 'pointer';
						  
						  const zoomIcon = document.createElement('img');
						  zoomIcon.src = 'https://i.imgur.com/9YXErYJ.png';
						  zoomIcon.alt = 'Zoom';
						  zoomIcon.style.width = '100%';
						  zoomIcon.style.height = '100%';
						  zoomIcon.style.objectFit = 'contain';
						  
						  zoomButton.appendChild(zoomIcon);
						  imageContainer.appendChild(imageElement);
						  imageContainer.appendChild(zoomButton);
						  
						  // Adiciona o leftContainer e o imageContainer ao mainContainer
						  mainContainer.appendChild(leftContainer);
						  mainContainer.appendChild(imageContainer);
						  
						  // Botão "Votar Novamente"
						  const votarButton = document.createElement('button');
						  votarButton.textContent = 'Votar Novamente';
						  votarButton.style.width = '100%';
						  votarButton.style.maxWidth = '460px';
						  votarButton.style.backgroundColor = '#5c0099';
						  votarButton.style.color = 'white';
						  votarButton.style.border = 'none';
						  votarButton.style.borderRadius = '2px';
						  votarButton.style.padding = '12px 0';
						  votarButton.style.fontSize = '16px';
						  votarButton.style.fontWeight = 'bold';
						  votarButton.style.cursor = 'pointer';
						  votarButton.style.marginBottom = '20px';
						  votarButton.style.display = 'block';
						  votarButton.style.marginLeft = 'auto';
						  votarButton.style.marginRight = 'auto';
						  votarButton.addEventListener('click', function() {
							location.reload();
						  });
						  
						  // Texto "CONTINUE VOTANDO:"
						  const newContinueText = document.createElement('div');
						  newContinueText.textContent = 'CONTINUE VOTANDO:';
						  newContinueText.style.color = '#666';
						  newContinueText.style.marginTop = '20px';
						  newContinueText.style.marginBottom = '10px';
						  newContinueText.style.fontSize = '14px';
						  newContinueText.style.textAlign = 'center';
						  
						  // Adicionando elementos ao conteúdo na ordem correta
						  content.insertBefore(mainContainer, voteButtonContainer);
						  content.insertBefore(votarButton, voteButtonContainer);
						  content.insertBefore(newContinueText, voteButtonContainer);
						  
						  // Reduzir a largura do elemento vote-button-container também
						  voteButtonContainer.style.maxWidth = '400px';
						  voteButtonContainer.style.margin = '0 auto';

						  // Adicione este código para garantir que o conteúdo empurre o rodapé para baixo
						  const spacerDiv = document.createElement('div');
						  spacerDiv.style.width = '100%';
						  spacerDiv.style.height = '50px';
						  spacerDiv.style.clear = 'both';
						  content.appendChild(spacerDiv);

						  // Certifique-se de que o rodapé fique no final da página
						  const footer = document.querySelector('.footer');
						  if (footer) {
							document.body.appendChild(footer);
							footer.style.marginTop = 'auto';
						  }

						  // Forçar o body a ter um layout que empurre o rodapé para o final
						  document.body.style.minHeight = '100vh';
						  document.body.style.display = 'flex';
						  document.body.style.flexDirection = 'column';
						  document.body.style.justifyContent = 'space-between';

						  // Remove o overlay de fade
						  fadeOverlay.style.opacity = '0';
						  setTimeout(() => {
							fadeOverlay.remove();
						  }, 300);
						}, 300); // Tempo do fade
					  }, 800); // Tempo do processamento
				  }).catch(error => {
					console.error("Erro ao processar o voto:", error);
					alert("Ocorreu um erro ao registrar seu voto. Por favor, tente novamente.");
					
					// Reativar a interface em caso de erro
					processingContainer.style.display = 'none';
					recaptchaContainer.style.display = 'flex';
					window.captchaCallbackExecuted = false;
					
					// Reativar os cards em caso de erro
					const allCards = document.querySelectorAll('.participant-card');
					allCards.forEach(card => {
					  card.style.opacity = '1';
					  card.style.pointerEvents = 'auto';
					});
					
					// Remover overlay em caso de erro
					if (disableInteractionOverlay) {
					  disableInteractionOverlay.remove();
					}
				  });
				} else {
				  // Fallback caso o Firebase não esteja disponível
				  console.warn("Firebase não está disponível. Usando armazenamento local");
				  
				  // Salva voto localmente
				  const votosLocal = JSON.parse(localStorage.getItem('bbb_votos')) || [];
				  votosLocal.push({
					candidato: participantName,
					timestamp: new Date().toISOString()
				  });
				  localStorage.setItem('bbb_votos', JSON.stringify(votosLocal));
				  
				  // Continue com o fluxo normal da aplicação
				  setTimeout(() => {
					processingContainer.style.display = 'none';
					recaptchaContainer.style.display = 'flex';
					
					// Scroll automático para posicionar o captcha com um ajuste para baixo
					setTimeout(() => {
						const topPos = confirmationFrame.offsetTop - 80;
						window.scrollTo({
							top: topPos,
							behavior: 'smooth'
						});
					}, 100);
					
					// Reset do Turnstile se necessário
					if (typeof turnstile !== 'undefined' && turnstile.reset) {
						turnstile.reset();
					}
				});
			});
			
			// Adiciona evento para o botão "Votar Novamente"
			const votarButton = document.querySelector('.vote-button-container');
			if (votarButton) {
				votarButton.addEventListener('click', function() {
					// Recarrega a página para reiniciar o processo
					location.reload();
				});
			}
			
			// Função de callback para quando o captcha é validado com sucesso
			window.onCaptchaSuccess = function(token) {
				console.log("Captcha validado com sucesso!", token);
				
				// Verifica se há um token válido e se há um participante selecionado
				if (!token || !document.querySelector('.participant-card.selected')) {
					console.log("Token inválido ou nenhum participante selecionado");
					return;
				}
				
				// Evita múltiplas execuções
				if (window.captchaCallbackExecuted) {
					console.log("Callback já executado anteriormente");
					return;
				}
				
				// Marca que o callback já foi executado
				window.captchaCallbackExecuted = true;
				
				// Pega o nome do participante selecionado
				const participantName = selectedNameSpan.textContent;
				console.log("Processando voto para:", participantName);
				
				// Oculta o container do captcha
				recaptchaContainer.style.display = 'none';
				
				// Mostra a animação de processamento
				processingContainer.style.display = 'flex';
				console.log("Container de processamento exibido");
				
				// IMPORTANTE: Aplica imediatamente o efeito esbranquiçado aos cards não selecionados
				// Crie um overlay para desabilitar interação com os cards
				const disableInteractionOverlay = document.createElement('div');
				disableInteractionOverlay.style.position = 'fixed';
				disableInteractionOverlay.style.top = '0';
				disableInteractionOverlay.style.left = '0';
				disableInteractionOverlay.style.width = '100%';
				disableInteractionOverlay.style.height = '100%';
				disableInteractionOverlay.style.zIndex = '990';
				disableInteractionOverlay.style.backgroundColor = 'transparent';
				document.body.appendChild(disableInteractionOverlay);

				// Aplica efeito esbranquiçado aos cards não selecionados IMEDIATAMENTE
				const allCards = document.querySelectorAll('.participant-card:not(.selected)');
				allCards.forEach(card => {
					card.style.opacity = '0.4';
					card.style.pointerEvents = 'none'; // Desabilita interação
					card.style.transition = 'opacity 0.3s ease'; // Adiciona transição suave
				});
				
				// Processo de votação
				setTimeout(() => {
					votar(participantName).then(success => {
						if (!success) {
							console.error("Falha ao registrar o voto para " + participantName);
						}
						
						console.log("Continuando com o fluxo de confirmação");
						
						// Após 800ms, inicia a transição para a tela de confirmação
						setTimeout(() => {
							processingContainer.style.display = 'none';
							
							// Cria um overlay branco para o efeito fade
							const fadeOverlay = document.createElement('div');
							fadeOverlay.style.position = 'fixed';
							fadeOverlay.style.top = '0';
							fadeOverlay.style.left = '0';
							fadeOverlay.style.width = '100%';
							fadeOverlay.style.height = '100%';
							fadeOverlay.style.backgroundColor = 'white';
							fadeOverlay.style.zIndex = '9999';
							fadeOverlay.style.opacity = '0';
							fadeOverlay.style.transition = 'opacity 0.3s ease';
							document.body.appendChild(fadeOverlay);
							
							// Força o reflow para que a transição funcione
							void fadeOverlay.offsetWidth;
							
							// Inicia o fade
							fadeOverlay.style.opacity = '1';
							
							// Inicia o scroll automático para o topo durante o fade
							const scrollToTopAnimation = () => {
								const currentPosition = window.pageYOffset;
								if (currentPosition > 0) {
									// Cria um efeito de animação suave
									window.scrollTo({
										top: currentPosition - Math.max(currentPosition / 10, 20),
										behavior: 'auto'
									});
									
									// Continue a animação enquanto o fade estiver acontecendo
									if (currentPosition > 0 && parseFloat(fadeOverlay.style.opacity) < 1) {
										requestAnimationFrame(scrollToTopAnimation);
									}
								}
							};
							
							// Inicia a animação de scroll
							requestAnimationFrame(scrollToTopAnimation);
							
							// Após o fade, reorganiza a página
							setTimeout(() => {
								// Scroll imediatamente para o topo (garante que chegamos ao topo)
								window.scrollTo({
									top: 0,
									behavior: 'auto'
								});
								
								// Remove o overlay de desativação
								if (disableInteractionOverlay) {
									disableInteractionOverlay.remove();
								}
									
								// Guarda referências aos elementos que vamos precisar
								const mainTitle = document.querySelector('.main-title');
								const subtitle = document.querySelector('.subtitle');
								const participantContainer = document.querySelector('.participant-container');
								const confirmationFrame = document.getElementById('confirmationFrame');
								const content = document.querySelector('.content');
								const continueText = document.querySelector('.continue-text');
								const voteButtonContainer = document.querySelector('.vote-button-container');
								
								// Guarda informações do participante selecionado
								const participantName = selectedNameSpan.textContent;
								const participantImage = selectedParticipant.querySelector('.participant-image').src;
								
								// Remove elementos existentes
								if (mainTitle) mainTitle.remove();
								if (subtitle) subtitle.remove();
								if (participantContainer) participantContainer.remove();
								if (confirmationFrame) confirmationFrame.remove();
								if (continueText) continueText.remove();
								
								// Reduzir a largura do conteúdo
								content.style.maxWidth = '500px';
								
								// Container principal para o checkmark, "Seu voto" e imagem
								const mainContainer = document.createElement('div');
								mainContainer.style.display = 'flex';
								mainContainer.style.justifyContent = 'space-between';
								mainContainer.style.alignItems = 'flex-start';
								mainContainer.style.width = '100%';
								mainContainer.style.marginBottom = '16px';
								
								// Container para a parte esquerda (check, "Seu voto" e nome)
								const leftContainer = document.createElement('div');
								leftContainer.style.display = 'flex';
								leftContainer.style.flexDirection = 'column';
								
								// Container para o checkmark e "Seu voto"
								const checkContainer = document.createElement('div');
								checkContainer.style.display = 'flex';
								checkContainer.style.alignItems = 'center';
								checkContainer.style.gap = '10px';
								checkContainer.style.marginBottom = '10px';
								
								// Ícone de check verde
								const checkIcon = document.createElement('img');
								checkIcon.src = 'https://i.imgur.com/20oSdRq.png';
								checkIcon.alt = 'Check';
								checkIcon.style.width = '20px';
								checkIcon.style.height = '20px';
								
								// Texto "Seu voto"
								const seuVotoText = document.createElement('span');
								seuVotoText.textContent = 'Seu voto';
								seuVotoText.style.color = '#333';
								seuVotoText.style.fontSize = '16px';
								seuVotoText.style.fontFamily = 'Roboto, sans-serif';
								seuVotoText.style.fontWeight = '200';
								
								// Adiciona os elementos ao checkContainer
								checkContainer.appendChild(checkIcon);
								checkContainer.appendChild(seuVotoText);
								
								// Nome do participante
								const nameElement = document.createElement('h2');
								nameElement.textContent = participantName;
								nameElement.style.fontSize = '32px';
								nameElement.style.fontFamily = 'Open Sans, helvetica, arial, sans-serif';
								nameElement.style.fontWeight = '700';
								nameElement.style.color = 'rgb(17, 17, 17)';
								nameElement.style.lineHeight = '1.2';
								nameElement.style.letterSpacing = '-1.5px';
								nameElement.style.margin = '0';
								
								// Adiciona o checkContainer e o nameElement ao leftContainer
								leftContainer.appendChild(checkContainer);
								leftContainer.appendChild(nameElement);
								
								// Container da imagem
								const imageContainer = document.createElement('div');
								imageContainer.style.position = 'relative';
								imageContainer.style.width = '90px';
								imageContainer.style.height = '90px';
								imageContainer.style.borderRadius = '8px';
								imageContainer.style.overflow = 'hidden';
								imageContainer.style.border = 'none';
								imageContainer.style.flexShrink = '0';
								
								// Imagem do participante
								const imageElement = document.createElement('img');
								imageElement.src = participantImage;
								imageElement.alt = participantName;
								imageElement.style.width = '90px';
								imageElement.style.height = '90px';
								imageElement.style.objectFit = 'cover';
								
								// Botão de zoom
								const zoomButton = document.createElement('div');
								zoomButton.style.position = 'absolute';
								zoomButton.style.bottom = '7px';
								zoomButton.style.left = '7px';
								zoomButton.style.width = '18px';
								zoomButton.style.height = '18px';
								zoomButton.style.display = 'flex';
								zoomButton.style.justifyContent = 'center';
								zoomButton.style.alignItems = 'center';
								zoomButton.style.zIndex = '10';
								zoomButton.style.cursor = 'pointer';
								
								const zoomIcon = document.createElement('img');
								zoomIcon.src = 'https://i.imgur.com/9YXErYJ.png';
								zoomIcon.alt = 'Zoom';
								zoomIcon.style.width = '100%';
								zoomIcon.style.height = '100%';
								zoomIcon.style.objectFit = 'contain';
								
								zoomButton.appendChild(zoomIcon);
								imageContainer.appendChild(imageElement);
								imageContainer.appendChild(zoomButton);
								
								// Adiciona o leftContainer e o imageContainer ao mainContainer
								mainContainer.appendChild(leftContainer);
								mainContainer.appendChild(imageContainer);
								
								// Botão "Votar Novamente"
								const votarButton = document.createElement('button');
								votarButton.textContent = 'Votar Novamente';
								votarButton.style.width = '100%';
								votarButton.style.maxWidth = '460px';
								votarButton.style.backgroundColor = '#5c0099';
								votarButton.style.color = 'white';
								votarButton.style.border = 'none';
								votarButton.style.borderRadius = '2px';
								votarButton.style.padding = '12px 0';
								votarButton.style.fontSize = '16px';
								votarButton.style.fontWeight = 'bold';
								votarButton.style.cursor = 'pointer';
								votarButton.style.marginBottom = '20px';
								votarButton.style.display = 'block';
								votarButton.style.marginLeft = 'auto';
								votarButton.style.marginRight = 'auto';
								votarButton.addEventListener('click', function() {
									location.reload();
								});
								
								// Texto "CONTINUE VOTANDO:"
								const newContinueText = document.createElement('div');
								newContinueText.textContent = 'CONTINUE VOTANDO:';
								newContinueText.style.color = '#666';
								newContinueText.style.marginTop = '20px';
								newContinueText.style.marginBottom = '10px';
								newContinueText.style.fontSize = '14px';
								newContinueText.style.textAlign = 'center';
								
								// Adicionando elementos ao conteúdo na ordem correta
								content.insertBefore(mainContainer, voteButtonContainer);
								content.insertBefore(votarButton, voteButtonContainer);
								content.insertBefore(newContinueText, voteButtonContainer);
								
								// Reduzir a largura do elemento vote-button-container também
								voteButtonContainer.style.maxWidth = '400px';
								voteButtonContainer.style.margin = '0 auto';

								// Adicione este código para garantir que o conteúdo empurre o rodapé para baixo
								const spacerDiv = document.createElement('div');
								spacerDiv.style.width = '100%';
								spacerDiv.style.height = '50px';
								spacerDiv.style.clear = 'both';
								content.appendChild(spacerDiv);

								// Certifique-se de que o rodapé fique no final da página
								const footer = document.querySelector('.footer');
								if (footer) {
									document.body.appendChild(footer);
									footer.style.marginTop = 'auto';
								}

								// Forçar o body a ter um layout que empurre o rodapé para o final
								document.body.style.minHeight = '100vh';
								document.body.style.display = 'flex';
								document.body.style.flexDirection = 'column';
								document.body.style.justifyContent = 'space-between';

								// Remove o overlay de fade
								fadeOverlay.style.opacity = '0';
								setTimeout(() => {
									fadeOverlay.remove();
								}, 300);
							}, 300); // Tempo do fade
						}, 800); // Tempo do processamento
					}).catch(error => {
						console.error("Erro ao processar o voto:", error);
						alert("Ocorreu um erro ao registrar seu voto. Por favor, tente novamente.");
						// Reativar a interface em caso de erro
						processingContainer.style.display = 'none';
						recaptchaContainer.style.display = 'flex';
						window.captchaCallbackExecuted = false;
						
						// Reativar os cards em caso de erro
						const allCards = document.querySelectorAll('.participant-card');
						allCards.forEach(card => {
							card.style.opacity = '1';
							card.style.pointerEvents = 'auto';
						});
						
						// Remover overlay em caso de erro
						if (disableInteractionOverlay) {
							disableInteractionOverlay.remove();
						}
					});
				}, 500); // Pequeno delay para garantir que a UI seja atualizada
			};
		});
	</script>
</body>
</html>