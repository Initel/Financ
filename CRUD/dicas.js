function enviarPerfil() {
  const form = document.getElementById('investorForm');
  const formData = new FormData(form);
  
  fetch('perfil_investidor.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      // Verifica se não houve erro na resposta
      if (data.error) {
          alert('Erro: ' + data.error);
      } else {
          // Exibe o perfil e as dicas em um alerta
          alert(`Seu perfil de investidor é: ${data.perfil}\n\nDicas: ${data.dicas}`);
      }
  })
  .catch(error => console.error('Erro:', error));
}
