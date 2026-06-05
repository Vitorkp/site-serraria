<?php
require_once 'config.php';

// Busca todos os produtos
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY id ASC");
$produtos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title data-i18n="produtos.metaTitulo">
    Products - Florestal Pinus
  </title>

  <link rel="icon" type="image/png" href="logo-florestal.png">
  <link rel="stylesheet" href="style.css">
</head>

<body>

<header>

  <div class="logo">Florestal <span>Pinus</span></div>

  <nav>
    <a href="index.html" data-i18n="nav.inicio">Home</a>
    <a href="orcamento.html" data-i18n="nav.orcamento">Quote</a>
  </nav>
  <div class="header-actions">

  <a href="login.php" class="login-topo" data-i18n="nav.login">
    Login
  </a>

  <div class="toggle-container">

    <span class="toggle-label pt-label ativo">
      PT
    </span>

    <label class="switch">

      <input
        type="checkbox"
        id="lang-checkbox"
        onchange="alternarSwitch(this)"
      >

      <div class="slider">
        <div class="knob"></div>
      </div>

    </label>

    <span class="toggle-label en-label">
      EN
    </span>

  </div>

</div>

</header>

<section class="produtos-tabs">

  <h1 class="titulo reveal" data-i18n="produtos.titulo">
    Products
  </h1>

  <p class="subtitulo reveal" data-i18n="produtos.subtitulo">
    Pine wood products for export and derivatives for the domestic market.
  </p>

  <div class="produtos-grid" id="produtosGrid">
    <!-- Produtos serão carregados aqui via JavaScript -->
  </div>

</section>

<footer>
  <p data-i18n="footer.texto">
    &copy; 2026 Florestal Pinus - Fast service for quotations.
  </p>
</footer>

<script src="script.js?v=1.1"></script>
<script>
// Carrega produtos do banco de dados
// Função para formatar o texto da descrição (converte quebras de linha e listas)
function formatarDescricao(texto) {
  if (!texto) return '';
  
  // Substitui linhas que começam com "-" ou "*" por itens de lista <li>
  // Primeiro, divide por linhas
  let linhas = texto.split('\n');
  let html = '';
  let emLista = false;
  
  linhas.forEach(linha => {
    linha = linha.trim();
    if (linha.startsWith('- ') || linha.startsWith('* ')) {
      if (!emLista) {
        html += '<ul style="margin: 10px 0; padding-left: 20px;">';
        emLista = true;
      }
      html += `<li>${linha.substring(2)}</li>`;
    } else if (linha === '') {
      if (emLista) {
        html += '</ul>';
        emLista = false;
      }
      html += '<br>';
    } else {
      if (emLista) {
        html += '</ul>';
        emLista = false;
      }
      // Suporte básico para negrito: **texto**
      linha = linha.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
      html += `<p style="margin-bottom: 8px;">${linha}</p>`;
    }
  });
  
  if (emLista) html += '</ul>';
  
  return html;
}

async function carregarProdutos() {
  const idioma = localStorage.getItem('idioma') || 'en';
  
  try {
    const response = await fetch(`api_produtos.php?idioma=${idioma}`);
    const data = await response.json();
    // console.log("Dados recebidos da API:", data);
    
    if (data.status === 'success') {
      const grid = document.getElementById('produtosGrid');
      grid.innerHTML = '';
      
      data.produtos.forEach((produto, index) => {
        const badgeKey = produto.mercado === 'Exportação' ? 'produtos.cerca.badge' : 'produtos.cavaco.badge';
        const badgeText = produto.mercado;
        
        const card = document.createElement('div');
        card.className = 'produto-novo card-hover reveal';
        card.innerHTML = `
          <div class="produto-img">
            <img src="${produto.foto}" alt="${produto.nome}">
          </div>
          <span class="badge">${badgeText}</span>
          <h3>${produto.nome}</h3>
          <div class="produto-descricao">${formatarDescricao(produto.descricao)}</div>
          <div style="margin-top: 15px;">
            <a href="orcamento.html?produto=${encodeURIComponent(produto.nome)}" class="btn-acao" style="background: var(--verde); color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; display: inline-block;">
              ${idioma === 'pt' ? 'Solicitar orçamento' : 'Request quote'}
            </a>
          </div>
        `;
        grid.appendChild(card);
        // Garante que o elemento seja revelado se já estiver na tela
        setTimeout(() => card.classList.add('ativo'), 100);
      });
      
      // Reaplica efeitos de hover aos novos cards
      const cards = document.querySelectorAll(".card-hover");
      cards.forEach((card) => {
        card.addEventListener("mousemove", (e) => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          const rotateX = ((y / rect.height) - 0.5) * -8;
          const rotateY = ((x / rect.width) - 0.5) * 8;
          card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });
        card.addEventListener("mouseleave", () => {
          card.style.transform = "rotateX(0) rotateY(0) translateY(0)";
        });
      });
    }
  } catch (error) {
    console.error('Erro ao carregar produtos:', error);
  }
}

// Carrega produtos ao iniciar a página
window.addEventListener('load', () => {
  carregarProdutos();
});

// Recarrega produtos quando o idioma muda
const originalMudarIdioma = window.mudarIdioma;
window.mudarIdioma = function(idioma) {
  originalMudarIdioma(idioma);
  carregarProdutos();
};
</script>

</body>
</html>
