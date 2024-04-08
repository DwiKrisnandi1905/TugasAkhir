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
  const notificationCards = document.querySelectorAll(".notification-card");
  const readStatus = document.querySelector(".read-status");

  readStatus.addEventListener("click", function() {
    notificationCards.forEach(function(card) {
      card.style.backgroundColor = "white";
    });
  });

  notificationCards.forEach(function(card) {
    card.addEventListener("click", function() {
      card.style.backgroundColor = "white";
    });
  });
});
// end notifikasi