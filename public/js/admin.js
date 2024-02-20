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