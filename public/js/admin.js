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

  function confirmDelete() {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data akan terhapus secara permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Data terhapus!',
          'Data telah dihapus.',
          'success'
        );
      }
    });
  }