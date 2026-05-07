// Animação ao rolar
const elementos = document.querySelectorAll(".reveal");

function revelarElementos() {
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