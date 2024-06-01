// sidebar
const hamBurger = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");
const main = document.querySelector(".main");

hamBurger.addEventListener("click", function () {
  sidebar.classList.toggle("expand");
  
  if (sidebar.classList.contains("expand")) {
    main.style.marginLeft = "220px";
  } else {
    main.style.marginLeft = "70px";
  }
});
// document.querySelector("#sidebar").classList.add("expand");
// end sidebar 

// notifikasi
document.addEventListener("DOMContentLoaded", function() {
  const pesananCards = document.querySelectorAll(".pesanan-card");
  const pesanCards = document.querySelectorAll(".pesan-card");
  const readPesanan = document.querySelector(".read-pesanan");
  const readPesan = document.querySelector(".read-pesan");

  readPesanan.addEventListener("click", function() {
    pesananCards.forEach(function(card) {
      card.style.backgroundColor = "white";
    });
  });

  readPesan.addEventListener("click", function() {
    pesanCards.forEach(function(card) {
      card.style.backgroundColor = "white";
    });
  });

  pesananCards.forEach(function(card) {
    card.addEventListener("click", function() {
      card.style.backgroundColor = "white";
    });
  });

  pesanCards.forEach(function(card) {
    card.addEventListener("click", function() {
      card.style.backgroundColor = "white";
    });
  });
});
// end notifikasi