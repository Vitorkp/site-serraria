// Animação ao rolar
function revelarElementos() {
  const elementos = document.querySelectorAll(".reveal");
  elementos.forEach((el) => {
    const posicao = el.getBoundingClientRect().top;
    const alturaTela = window.innerHeight;

    if (posicao < alturaTela - 80) {
      el.classList.add("ativo");
    }
  });
}

window.addEventListener("scroll", revelarElementos);
window.addEventListener("load", revelarElementos);


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


function atualizarMoeda() {
  const pais = document.getElementById("pais");
  const moeda = document.getElementById("moeda");

  if (!pais || !moeda) return;

  if (pais.value === "brasil") {
    moeda.value = "BRL";
  } else {
    moeda.value = "USD";
  }
}

const traducoes = {
  pt: {
    "nav.inicio": "Início",
    "nav.produtos": "Produtos",
    "nav.orcamento": "Orçamento",
    "nav.login": "Conecte-se",

    "hero.titulo": "Madeira de qualidade para construção e indústria",
    "hero.descricao":
      "Fornecemos madeira de pinus, pallets e cavaco com qualidade, entrega regional e atendimento rápido para empresas, obras e indústrias.",
    "hero.botaoProdutos": "Ver produtos",
    "hero.botaoOrcamento": "Solicitar orçamento",

    "heroCard.titulo": "Principais produtos",
    "heroCard.item1":
      "Madeira de pinus bruta, tratada e sob medida",
    "heroCard.item2":
      "Paletes novos, reforçados e personalizados",
    "heroCard.item3":
      "Cavaco para biomassa e uso industrial",

    "produtos.titulo": "Nossos Produtos",
    "produtos.subtitulo":
      "Soluções em madeira para diferentes necessidades",

    "produtos.pinus.titulo": "Madeira de Pinus",
    "produtos.pinus.descricao":
      "Madeira resistente para construção, marcenaria e uso industrial.",

    "produtos.pallets.titulo": "Pallets",
    "produtos.pallets.descricao":
      "Pallets para transporte, armazenamento e logística empresarial.",

    "produtos.cavaco.titulo": "Cavaco",
    "produtos.cavaco.descricao":
      "Cavaco de madeira para biomassa, granjas, caldeiras e indústrias.",

    "produtos.verMais": "Ver mais",

    "vantagens.titulo": "Por que escolher nossa serraria?",

    "vantagens.qualidade.titulo": "Florestas Renováveis",
    "vantagens.qualidade.descricao":
      "Comprometidos com florestas renováveis ​​​que protegem os recursos naturais",

    "vantagens.agilidade.titulo": "Agilidade",
    "vantagens.agilidade.descricao":
      "Produção eficiente e atendimento ágil para cumprir seus prazos.",

    "vantagens.personalizado.titulo": "Soluções personalizadas",
    "vantagens.personalizado.descricao":
      "Soluções personalizadas para cada tipo de cliente.",

    "sobre.tag": "Sobre a empresa",

    "sobre.titulo":
      "Produção Sustentável de Pinus para o Mercado Nacional e Internacional",

    "sobre.descricao1":
      "Desde 1995, a Florestal Pinus atua na produção e no processamento de produtos de madeira de pinus de alta qualidade, atendendo clientes do mercado nacional e internacional com eficiência, confiabilidade e excelência.",

    "sobre.descricao2":
      "Nossas operações utilizam madeira proveniente de florestas renováveis, garantindo uma cadeia produtiva responsável que respeita os recursos naturais e promove a sustentabilidade ambiental a longo prazo.",

    "sobre.descricao3":
      "Por meio de investimentos contínuos em produção, logística e aproveitamento de recursos, entregamos soluções que unem desempenho industrial e responsabilidade ambiental.",

    "sobre.destaque1": "🌲 Florestas Renováveis",
    "sobre.destaque2": "♻️ Produção Sustentável",
    "sobre.destaque3": "🌍 Exportação Internacional",

    "sobre.botao": "Conheça a empresa",

    "numeros.titulo": "Florestal Pinus em números",
    "numeros.fundacao": "ano de fundação",
    "numeros.containers": "containers produzidos por mês",
    "numeros.mercados": "principais mercados internacionais",
    "numeros.pedidos": "dias de programação de pedidos",
    "produtos.titulo": "Nossos Produtos",
    "produtos.subtitulo": "Produtos de pinus para exportação e derivados para o mercado interno.",
    "produtos.preco": "Preço:",
    "produtos.botaoOrcamento": "Solicitar orçamento",

    "produtos.cerca.badge": "Exportação",
    "produtos.cerca.titulo": "Cercas de Pinus",
    "produtos.cerca.descricao": "Tábuas para cercas produzidas para o mercado internacional.",
    "produtos.cerca.item1": "15 mm de espessura",
    "produtos.cerca.item2": "140 mm de largura",
    "produtos.cerca.item3": "1830 mm de comprimento",
    "produtos.cerca.item4": "Outras bitolas sob consulta",
    "produtos.cerca.preco": "sob consulta em USD",

    "produtos.pallet.badge": "Exportação",
    "produtos.pallet.titulo": "Paletes Internacionais",
    "produtos.pallet.descricao": "Paletes produzidos para Europa e Emirados Árabes.",
    "produtos.pallet.item1": "Produção sob demanda",
    "produtos.pallet.item2": "Programação de 60 a 120 dias",
    "produtos.pallet.item3": "Entregas mensais conforme a demanda",
    "produtos.pallet.preco": "sob consulta em USD",

    "produtos.cavaco.badge": "Mercado Interno",
    "produtos.cavaco.titulo": "Cavaco",
    "produtos.cavaco.descricao": "Vendido para fábricas de MDF e indústrias de geração de energia por biomassa.",
    "produtos.cavaco.item1": "Uso industrial",
    "produtos.cavaco.item2": "MDF",
    "produtos.cavaco.item3": "Biomassa",
    "produtos.cavaco.preco": "sob consulta em BRL",

    "produtos.serragem.badge": "Mercado Interno",
    "produtos.serragem.titulo": "Serragem",
    "produtos.serragem.descricao": "Material vendido para fábricas de pellets.",
    "produtos.serragem.item1": "Subproduto industrial",
    "produtos.serragem.item2": "Aproveitamento da madeira",
    "produtos.serragem.item3": "Fornecimento sob demanda",
    "produtos.serragem.preco": "sob consulta em BRL",

    "produtos.casca.badge": "Mercado Interno",
    "produtos.casca.titulo": "Casca de Pinus",
    "produtos.casca.descricao": "Produto destinado principalmente à jardinagem e paisagismo.",
    "produtos.casca.item1": "Jardinagem",
    "produtos.casca.item2": "Paisagismo",
    "produtos.casca.item3": "Aproveitamento sustentável",
    "produtos.casca.preco": "sob consulta em BRL",

    "orcamento.metaTitulo": "Orçamento - Florestal Pinus",
    "orcamento.titulo": "Solicite seu orçamento",
    "orcamento.subtitulo": "Preencha as informações abaixo e nossa equipe entrará em contato",
    "orcamento.nomeLabel": "Nome completo",
    "orcamento.nomePlaceholder": "Digite seu nome",
    "orcamento.telefoneLabel": "Telefone / WhatsApp",
    "orcamento.emailLabel": "E-mail",
    "orcamento.emailPlaceholder": "seu@email.com",
    "orcamento.produtoLabel": "Produto desejado",
    "orcamento.produtoSelecionar": "Selecione um produto",
    "orcamento.produtoPinus": "Madeira de Pinus",
    "orcamento.produtoPallets": "Pallets",
    "orcamento.produtoCavaco": "Cavaco",
    "orcamento.quantidadeLabel": "Quantidade aproximada",
    "orcamento.quantidadePlaceholder": "Exemplo: 50 unidades, 10m³, 2 toneladas",
    "orcamento.cidadeLabel": "Cidade",
    "orcamento.cidadePlaceholder": "Digite sua cidade",
    "orcamento.observacoesLabel": "Observações",
    "orcamento.observacoesPlaceholder": "Descreva os detalhes do pedido",
    "orcamento.botaoEnviar": "Enviar solicitação de orçamento",
    "orcamento.sucesso": "Sucesso!",
    "orcamento.mensagemSucesso": "Orçamento enviado conforme a imagem. Nossa equipe entrará em contato em breve.",
    "orcamento.erro": "Erro!",
    "orcamento.mensagemErro": "Erro ao enviar o orçamento. Tente novamente.",

    "footer.texto": "© 2026 Florestal Pinus - Atendimento rápido para orçamentos."
  },


  en: {
    "nav.inicio": "Home",
    "nav.produtos": "Products",
    "nav.orcamento": "Quote",
    "nav.login": "Login",

    "hero.titulo":
      "Quality wood for construction and industry",

    "hero.descricao":
      "We supply pine wood, pallets and wood chips with quality, regional delivery and fast service for companies, construction sites and industries.",

    "hero.botaoProdutos": "View products",
    "hero.botaoOrcamento": "Request a quote",

    "heroCard.titulo": "Main Products",
    "heroCard.item1":
      "Raw, treated and custom pine wood",
    "heroCard.item2":
      "New, reinforced and customized pallets",
    "heroCard.item3":
      "Wood chips for biomass and industrial use",

    "produtos.titulo": "Our Products",
    "produtos.subtitulo":
      "Wood solutions for different needs",

    "produtos.pinus.titulo": "Pine Wood",
    "produtos.pinus.descricao":
      "Durable wood for construction, carpentry and industrial use.",

    "produtos.pallets.titulo": "Pallets",
    "produtos.pallets.descricao":
      "Pallets for transportation, storage and business logistics.",

    "produtos.cavaco.titulo": "Wood Chips",
    "produtos.cavaco.descricao":
      "Wood chips for biomass, farms, boilers and industries.",

    "produtos.verMais": "View more",

    "vantagens.titulo": "Why choose our sawmill?",

    "vantagens.qualidade.titulo": "Renewable Forests",
    "vantagens.qualidade.descricao":
      "Committed to renewable forests that protect natural resources..",

    "vantagens.agilidade.titulo": "Agility",
    "vantagens.agilidade.descricao":
      "Efficient production and responsive service to meet your deadlines.",

    "vantagens.personalizado.titulo": "Custom Solutions",
    "vantagens.personalizado.descricao":
      "Personalized solutions for every type of client.",

    "sobre.tag": "About the Company",

    "sobre.titulo":
      "Sustainable Pine Production for Domestic and International Markets",

    "sobre.descricao1":
      "Since 1995, Florestal Pinus has specialized in the production and processing of high-quality pine wood products, serving both domestic and international markets with reliability, efficiency, and consistent quality.",

    "sobre.descricao2":
      "Our operations are supported by timber sourced from renewable forests, ensuring a responsible supply chain that respects natural resources and promotes long-term environmental sustainability.",

    "sobre.descricao3":
      "Through continuous investment in production, logistics, and resource optimization, we deliver solutions that combine industrial performance with environmental responsibility.",

    "sobre.destaque1": "🌲 Renewable Forests",
    "sobre.destaque2": "♻️ Sustainable Production",
    "sobre.destaque3": "🌍 International Export",

    "sobre.botao": "Learn More About the Company",

    "numeros.titulo": "Florestal Pinus sul Brasil in numbers",
    "numeros.fundacao": "foundation year",
    "numeros.containers": "containers produced per month",
    "numeros.mercados": "main international markets",
    "numeros.pedidos": "days for order scheduling",
    "produtos.titulo": "Our Products",
    "produtos.subtitulo": "Pine wood products for export and derivatives for the domestic market.",
    "produtos.preco": "Price:",
    "produtos.botaoOrcamento": "Request a quote",

    "produtos.cerca.badge": "Export",
    "produtos.cerca.titulo": "Pine Fences",
    "produtos.cerca.descricao": "Fence boards produced for international markets.",
    "produtos.cerca.item1": "15 mm thickness",
    "produtos.cerca.item2": "140 mm width",
    "produtos.cerca.item3": "1830 mm length",
    "produtos.cerca.item4": "Other dimensions upon request",
    "produtos.cerca.preco": "upon request in USD",

    "produtos.pallet.badge": "Export",
    "produtos.pallet.titulo": "International Pallets",
    "produtos.pallet.descricao": "Pallets produced for Europe and the United Arab Emirates.",
    "produtos.pallet.item1": "Production on demand",
    "produtos.pallet.item2": "Scheduling from 60 to 120 days",
    "produtos.pallet.item3": "Monthly delivery according to demand",
    "produtos.pallet.preco": "upon request in USD",

    "produtos.cavaco.badge": "Domestic Market",
    "produtos.cavaco.titulo": "Wood Chips",
    "produtos.cavaco.descricao": "Sold to MDF factories and biomass energy generation industries.",
    "produtos.cavaco.item1": "Industrial use",
    "produtos.cavaco.item2": "MDF",
    "produtos.cavaco.item3": "Biomass",
    "produtos.cavaco.preco": "upon request in BRL",

    "produtos.serragem.badge": "Domestic Market",
    "produtos.serragem.titulo": "Sawdust",
    "produtos.serragem.descricao": "Material sold to pellet factories.",
    "produtos.serragem.item1": "Industrial by-product",
    "produtos.serragem.item2": "Wood utilization",
    "produtos.serragem.item3": "Supply on demand",
    "produtos.serragem.preco": "upon request in BRL",

    "produtos.casca.badge": "Domestic Market",
    "produtos.casca.titulo": "Pine Bark",
    "produtos.casca.descricao": "Product mainly intended for gardening and landscaping.",
    "produtos.casca.item1": "Gardening",
    "produtos.casca.item2": "Landscaping",
    "produtos.casca.item3": "Sustainable utilization",
    "produtos.casca.preco": "upon request in BRL",

    "orcamento.metaTitulo": "Quote - Florestal Pinus",
    "orcamento.titulo": "Request your quote",
    "orcamento.subtitulo": "Fill in the information below and our team will contact you",
    "orcamento.nomeLabel": "Full name",
    "orcamento.nomePlaceholder": "Enter your name",
    "orcamento.telefoneLabel": "Phone / WhatsApp",
    "orcamento.emailLabel": "E-mail",
    "orcamento.emailPlaceholder": "your@email.com",
    "orcamento.produtoLabel": "Desired product",
    "orcamento.produtoSelecionar": "Select a product",
    "orcamento.produtoPinus": "Pine Wood",
    "orcamento.produtoPallets": "Pallets",
    "orcamento.produtoCavaco": "Wood Chips",
    "orcamento.quantidadeLabel": "Approximate quantity",
    "orcamento.quantidadePlaceholder": "Example: 50 units, 10m³, 2 tons",
    "orcamento.cidadeLabel": "City",
    "orcamento.cidadePlaceholder": "Enter your city",
    "orcamento.observacoesLabel": "Notes",
    "orcamento.observacoesPlaceholder": "Describe your request details",
    "orcamento.botaoEnviar": "Send quote request",
    "orcamento.sucesso": "Success!",
    "orcamento.mensagemSucesso": "Quote sent as per the image. Our team will contact you shortly.",
    "orcamento.erro": "Error!",
    "orcamento.mensagemErro": "Error sending the quote. Please try again.",

    "footer.texto": "© 2026 Florestal Pinus - Fast service for quotations."
  }
};

function mudarIdioma(idioma) {
  document.querySelectorAll("[data-i18n]").forEach((elemento) => {
    const chave = elemento.getAttribute("data-i18n");

    if (traducoes[idioma] && traducoes[idioma][chave]) {
      elemento.textContent = traducoes[idioma][chave];
    }
  });

  document.querySelectorAll("[data-i18n-placeholder]").forEach((elemento) => {
    const chave = elemento.getAttribute("data-i18n-placeholder");

    if (traducoes[idioma] && traducoes[idioma][chave]) {
      elemento.setAttribute("placeholder", traducoes[idioma][chave]);
    }
  });

  localStorage.setItem("idioma", idioma);
}

function alternarSwitch(checkbox) {
  const idioma = checkbox.checked ? "en" : "pt";
  mudarIdioma(idioma);

  document.querySelector(".pt-label")?.classList.toggle("ativo", idioma === "pt");
  document.querySelector(".en-label")?.classList.toggle("ativo", idioma === "en");
}

window.addEventListener("load", () => {
  const idiomaSalvo = localStorage.getItem("idioma") || "en";
  const checkbox = document.getElementById("lang-checkbox");

  mudarIdioma(idiomaSalvo);

  if (checkbox) {
    checkbox.checked = idiomaSalvo === "en";
    document.querySelector(".pt-label")?.classList.toggle("ativo", idiomaSalvo === "pt");
    document.querySelector(".en-label")?.classList.toggle("ativo", idiomaSalvo === "en");
  }
});


// Função para criar e exibir modal de sucesso
function criarModalSucesso(idioma) {
  // Remove modal anterior se existir
  const modalAnterior = document.getElementById('modalSucesso');
  if (modalAnterior) {
    modalAnterior.parentElement.remove();
  }

  // Cria overlay
  const overlay = document.createElement('div');
  overlay.style.position = 'fixed';
  overlay.style.top = '0';
  overlay.style.left = '0';
  overlay.style.width = '100%';
  overlay.style.height = '100%';
  overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
  overlay.style.display = 'flex';
  overlay.style.justifyContent = 'center';
  overlay.style.alignItems = 'center';
  overlay.style.zIndex = '9999';

  // Cria modal
  const modal = document.createElement('div');
  modal.id = 'modalSucesso';
  modal.style.backgroundColor = 'white';
  modal.style.borderRadius = '8px';
  modal.style.padding = '40px 30px';
  modal.style.textAlign = 'center';
  modal.style.maxWidth = '400px';
  modal.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
  modal.style.animation = 'slideIn 0.3s ease-out';

  // Ícone de checkmark
  const icone = document.createElement('div');
  icone.innerHTML = '✓';
  icone.style.fontSize = '60px';
  icone.style.color = '#4CAF50';
  icone.style.marginBottom = '20px';
  icone.style.fontWeight = 'bold';
  icone.style.width = '80px';
  icone.style.height = '80px';
  icone.style.borderRadius = '50%';
  icone.style.border = '3px solid #4CAF50';
  icone.style.display = 'flex';
  icone.style.alignItems = 'center';
  icone.style.justifyContent = 'center';
  icone.style.margin = '0 auto 20px';

  // Título
  const titulo = document.createElement('h2');
  titulo.textContent = traducoes[idioma]['orcamento.sucesso'];
  titulo.style.fontSize = '28px';
  titulo.style.color = '#333';
  titulo.style.marginBottom = '10px';
  titulo.style.fontWeight = '600';

  // Mensagem
  const mensagem = document.createElement('p');
  mensagem.textContent = traducoes[idioma]['orcamento.mensagemSucesso'];
  mensagem.style.fontSize = '16px';
  mensagem.style.color = '#666';
  mensagem.style.marginBottom = '30px';
  mensagem.style.lineHeight = '1.5';

  // Botão OK
  const botao = document.createElement('button');
  botao.textContent = 'OK';
  botao.style.backgroundColor = '#4CAF50';
  botao.style.color = 'white';
  botao.style.border = 'none';
  botao.style.padding = '12px 40px';
  botao.style.fontSize = '16px';
  botao.style.borderRadius = '4px';
  botao.style.cursor = 'pointer';
  botao.style.fontWeight = '600';
  botao.style.transition = 'background-color 0.3s';

  botao.addEventListener('mouseover', () => {
    botao.style.backgroundColor = '#45a049';
  });

  botao.addEventListener('mouseout', () => {
    botao.style.backgroundColor = '#4CAF50';
  });

  botao.addEventListener('click', () => {
    overlay.remove();
  });

  // Monta a estrutura
  modal.appendChild(icone);
  modal.appendChild(titulo);
  modal.appendChild(mensagem);
  modal.appendChild(botao);
  overlay.appendChild(modal);

  // Adiciona ao documento
  document.body.appendChild(overlay);

  // Fechar ao clicar no overlay
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      overlay.remove();
    }
  });
}

// Submissão do formulário de orçamento
window.addEventListener("load", () => {
  const formOrcamento = document.getElementById('formOrcamento');
  if (formOrcamento) {
    formOrcamento.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      const formData = new FormData(formOrcamento);
      const idioma = localStorage.getItem('idioma') || 'en';
      
      try {
        const response = await fetch('processar_orcamento.php', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.status === 'success') {
          // Exibe modal de sucesso
          criarModalSucesso(idioma);
          formOrcamento.reset();
        } else {
          const feedback = document.getElementById('feedback');
          feedback.style.display = 'block';
          feedback.style.backgroundColor = '#f8d7da';
          feedback.style.color = '#721c24';
          feedback.style.border = '1px solid #f5c6cb';
          
          const titulo = document.createElement('div');
          titulo.textContent = traducoes[idioma]['orcamento.erro'];
          titulo.style.fontSize = '20px';
          titulo.style.marginBottom = '10px';
          
          const mensagem = document.createElement('div');
          mensagem.textContent = data.message || traducoes[idioma]['orcamento.mensagemErro'];
          mensagem.style.fontSize = '14px';
          
          feedback.innerHTML = '';
          feedback.appendChild(titulo);
          feedback.appendChild(mensagem);
        }
      } catch (error) {
        const feedback = document.getElementById('feedback');
        feedback.style.display = 'block';
        feedback.style.backgroundColor = '#f8d7da';
        feedback.style.color = '#721c24';
        feedback.style.border = '1px solid #f5c6cb';
        
        const titulo = document.createElement('div');
        titulo.textContent = traducoes[idioma]['orcamento.erro'];
        titulo.style.fontSize = '20px';
        titulo.style.marginBottom = '10px';
        
        const mensagem = document.createElement('div');
        mensagem.textContent = traducoes[idioma]['orcamento.mensagemErro'];
        mensagem.style.fontSize = '14px';
        
        feedback.innerHTML = '';
        feedback.appendChild(titulo);
        feedback.appendChild(mensagem);
      }
    });
  }
});

// Adiciona animação de slide-in ao CSS
const style = document.createElement('style');
style.textContent = `
  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(-30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
`;
document.head.appendChild(style);
