<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="meta.titulo">Florestal Pinus</title>
  <link rel="icon" type="image/png" href="logo-florestal.png">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>

  <section class="hero">
    <div class="hero-texto">
      <h1 data-i18n="hero.titulo">
        Quality wood for construction and industry
      </h1>
      <p data-i18n="hero.descricao">
        We supply pine wood, pallets and wood chips with quality, regional delivery
        and fast service for companies, construction sites and industries.
      </p>
      <div class="botoes">
        <a href="produtos.php" class="btn btn-verde" data-i18n="hero.botaoProdutos">
          View products
        </a>
        <a href="orcamento.php" class="btn btn-marrom" data-i18n="hero.botaoOrcamento">
          Request a quote
        </a>
      </div>
    </div>
    <div class="hero-card">
      <h2 data-i18n="heroCard.titulo">
        Main products
      </h2>
      <ul>
        <li data-i18n="heroCard.item1">
          Raw, treated and custom pine wood
        </li>

        <li data-i18n="heroCard.item2">
          New, reinforced and customized pallets
        </li>

        <li data-i18n="heroCard.item3">
          Wood chips for biomass and industrial use
        </li>
      </ul>
    </div>
  </section>
  <section>
    <h2 class="titulo" data-i18n="produtos.titulo">
      Our Products
    </h2>

    <p class="subtitulo" data-i18n="produtos.subtitulo">
      Wood solutions for different needs
    </p>

    <div class="cards">
      <div class="card">
        <div class="icone">🌲</div>
        <h3 data-i18n="produtos.pinus.titulo">
          Pine Wood
        </h3>
        <p data-i18n="produtos.pinus.descricao">
          Durable wood for construction, carpentry and industrial use.
        </p>
        <a href="produtos.php" data-i18n="produtos.verMais">
          View more
        </a>
      </div>
      <div class="card">
        <div class="icone">📦</div>
        <h3 data-i18n="produtos.pallets.titulo">
          Pallets
        </h3>
        <p data-i18n="produtos.pallets.descricao">
          Pallets for transportation, storage and business logistics.
        </p>
        <a href="produtos.php" data-i18n="produtos.verMais">
          View more
        </a>
      </div>
      <div class="card">
        <div class="icone">🪵</div>
        <h3 data-i18n="produtos.cavaco.titulo">
          Wood Chips
        </h3>
        <p data-i18n="produtos.cavaco.descricao">
          Wood chips for biomass, farms, boilers and industries.
        </p>
        <a href="produtos.php" data-i18n="produtos.verMais">
          View more
        </a>
      </div>
    </div>
  </section>
  <section class="vantagens">
    <h2 class="titulo" data-i18n="vantagens.titulo">
      Why choose our sawmill?
    </h2>
    <div class="vantagens-container">
      <div class="vantagem">
        <h3 data-i18n="vantagens.qualidade.titulo">
          Renewable Resources
        </h3>
        <p data-i18n="vantagens.qualidade.descricao">
          Committed to renewable forests and sustainable practices that protect natural resources for future generations.
        </p>
      </div>
      <div class="vantagem">
        <h3 data-i18n="vantagens.agilidade.titulo">
          Agility
        </h3>
        <p data-i18n="vantagens.agilidade.descricao">
          Fast service for orders and quotations.
        </p>
      </div>
      <div class="vantagem">
        <h3 data-i18n="vantagens.personalizado.titulo">
          Custom Solutions
        </h3>
        <p data-i18n="vantagens.personalizado.descricao">
          Personalized solutions for every type of client.
        </p>
      </div>
    </div>
  </section>
  <section class="sobre-home reveal">

    <div class="sobre-grid">

        <div class="sobre-texto">

            <span class="sobre-tag" data-i18n="sobre.tag">
                🌱 About the Company
            </span>

            <h2 data-i18n="sobre.titulo">
                Sustainable Pine Production for Domestic and International Markets
            </h2>

            <p data-i18n="sobre.descricao1">
                Since 1995, Florestal Pinus has specialized in the production and processing
                of high-quality pine wood products, serving both domestic and international
                markets with reliability, efficiency, and consistent quality.
            </p>

            <p data-i18n="sobre.descricao2">
                Our operations are supported by timber sourced from renewable forests,
                ensuring a responsible supply chain that respects natural resources and
                promotes long-term environmental sustainability.
            </p>

            <p data-i18n="sobre.descricao3">
                Through continuous investment in production, logistics, and resource
                optimization, we deliver solutions that combine industrial performance
                with environmental responsibility.
            </p>

            <div class="sobre-destaques">

                <span data-i18n="sobre.destaque1">
                    🌲 Renewable Forests
                </span>

                <span data-i18n="sobre.destaque2">
                    ♻️ Sustainable Production
                </span>

                <span data-i18n="sobre.destaque3">
                    🌍 International Export
                </span>

            </div>

        </div>

        <div class="sobre-imagem">
            <img src="img/industria-aerea.png" alt="Florestal Pinus Industrial Facility">
        </div>

    </div>

</section>

<footer>
  <p data-i18n="footer.texto">
    &copy; 2026 Florestal Pinus Sul Brasil - Quality wood from cutting to transportation.
  </p>
</footer>

<a href="https://wa.me/5553999717893" target="_blank" class="whatsapp-btn">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
</a>

<script src="script.js"></script>
</body>
</html>