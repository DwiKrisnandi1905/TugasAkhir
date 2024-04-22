function confirmDelete(categoryId) {
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
        document.getElementById('deleteForm' + categoryId).submit();
      }
    });
  }