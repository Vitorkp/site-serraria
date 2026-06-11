<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title data-i18n="orcamento.metaTitulo">
    Quote - Florestal Pinus
  </title>

  <link rel="icon" type="image/png" href="logo-florestal.png">
  <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include 'includes/header.php'; ?>

<main>

  <section>

    <h1 class="titulo" data-i18n="orcamento.titulo">
      Request your quote
    </h1>

    <p class="subtitulo" data-i18n="orcamento.subtitulo">
      Fill in the information below and our team will contact you
    </p>

    <form class="formulario" id="formOrcamento">
      <label for="nome" data-i18n="orcamento.nomeLabel">
        Full name
      </label>

      <input
        type="text"
        id="nome"
        name="nome"
        data-i18n-placeholder="orcamento.nomePlaceholder"
        placeholder="Enter your name"
        required
      >

      <label for="telefone" data-i18n="orcamento.telefoneLabel">
        Phone / WhatsApp
      </label>

      <input
        type="tel"
        id="telefone"
        name="telefone"
        placeholder="(00) 00000-0000"
        required
      >

      <label for="email" data-i18n="orcamento.emailLabel">
        E-mail
      </label>

      <input
        type="email"
        id="email"
        name="email"
        data-i18n-placeholder="orcamento.emailPlaceholder"
        placeholder="your@email.com"
      >

      <label for="produto" data-i18n="orcamento.produtoLabel">
        Desired product
      </label>

      <select id="produto" name="produto" required>

        <option value="" data-i18n="orcamento.produtoSelecionar">
          Select a product
        </option>

      </select>

      <label for="quantidade" data-i18n="orcamento.quantidadeLabel">
        Approximate quantity
      </label>

      <input
        type="text"
        id="quantidade"
        name="quantidade"
        data-i18n-placeholder="orcamento.quantidadePlaceholder"
        placeholder="Example: 50 units, 10m³, 2 tons"
      >

      <label for="cidade" data-i18n="orcamento.cidadeLabel">
        City
      </label>

      <input
        type="text"
        id="cidade"
        name="cidade"
        data-i18n-placeholder="orcamento.cidadePlaceholder"
        placeholder="Enter your city"
      >

      <label for="mensagem" data-i18n="orcamento.observacoesLabel">
        Notes
      </label>

      <textarea
        id="mensagem"
        name="mensagem"
        rows="5"
        data-i18n-placeholder="orcamento.observacoesPlaceholder"
        placeholder="Describe your request details"
      ></textarea>

      <button type="submit" data-i18n="orcamento.botaoEnviar">
        Send quote request
      </button>
      <div id="feedback" style="display:none; margin-top: 20px; padding: 15px; border-radius: 8px; text-align: center; font-weight: bold;"></div>
    </form>
  </section>
</main>

<?php include 'includes/footer.php'; ?>

<script src="script.js"></script>
<script>
// Carrega produtos do banco de dados no select
async function carregarProdutosSelect() {
  const idioma = localStorage.getItem('idioma') || 'en';
  
  try {
    const response = await fetch(`api_produtos.php?idioma=${idioma}`);
    const data = await response.json();
    
    if (data.status === 'success') {
      const select = document.getElementById('produto');
      
      // Limpa opções anteriores mantendo a primeira
      while (select.options.length > 1) {
        select.remove(1);
      }
      
      // Adiciona produtos do banco
      data.produtos.forEach((produto) => {
        const option = document.createElement('option');
        option.value = produto.nome;
        option.textContent = produto.nome;
        select.appendChild(option);
      });
      
      // Se há parâmetro de produto na URL, seleciona
      const params = new URLSearchParams(window.location.search);
      const produtoParam = params.get('produto');
      if (produtoParam) {
        select.value = produtoParam;
      }
    }
  } catch (error) {
    console.error('Erro ao carregar produtos:', error);
  }
}

// Carrega produtos ao iniciar a página
window.addEventListener('load', () => {
  carregarProdutosSelect();
});

// Recarrega produtos quando o idioma muda
const originalMudarIdioma = window.mudarIdioma;
window.mudarIdioma = function(idioma) {
  originalMudarIdioma(idioma);
  carregarProdutosSelect();
};
</script>

<a href="https://wa.me/5553999717893" target="_blank" class="whatsapp-btn">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
</a>

</body>
</html>
