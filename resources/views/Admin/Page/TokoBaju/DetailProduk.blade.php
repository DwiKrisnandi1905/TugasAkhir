@extends('Admin.Layout.index')

@section('content')
<div class="card" id="detailTokobaju">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="text-primary" onclick="window.location='{{ route('tokobaju') }}';">
                <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
            </div>
        </div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th scope="row" class="col-4">Id Produk</th>
            <td id="idProduk">123</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Nama Produk</th>
            <td id="namaProduk">Jersey Futsal</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Kategori</th>
            <td id="kategori">Pakaian Olahraga Pria</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Foto Produk Untuk Tampilan Utama</th>
            <td id="fotoProduk">Pakaian_Olahraga_Pria.jpg</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Total Terjual</th>
            <td>75</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Penilaian Suka</th>
            <td>72</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Penilaian Tidak Suka</th>
            <td>3</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Penilaian Rating</th>
            <td>4.9</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Deskripsi</th>
            <td id="deskripsi">produk ini memiliki bahan yang berkualitas</td>
          </tr>
        </tbody>
      </table>
      <h4>Detail warna dan ukuran produk</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">Merah</th>
                </tr>
            </thead>            
            <thead>
            <tr>
                <th scope="col">Ukuran</th>
                <th scope="col">Harga</th>
                <th scope="col">Stock</th>
                <th scope="col">Terjual</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">XXXL</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">XXL</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">XL</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">L</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">M</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">Gambar</th>
                <td colspan="4">Merah.jpg</td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">Hitam</th>
                </tr>
            </thead>            
            <thead>
            <tr>
                <th scope="col">Ukuran</th>
                <th scope="col">Harga</th>
                <th scope="col">Stock</th>
                <th scope="col">Terjual</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">XXXL</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">XXL</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">XL</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">L</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">M</th>
                <td class="harga">Rp 80.000,00</td>
                <td class="stock">30</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
            <tr>
                <th scope="row">Gambar</th>
                <td colspan="4">Hitam.jpg</td>
            </tr>
            </tbody>
        </table>
        <div class="mb-3 justify-content-center d-flex gap-4">
            <button type="button" class="btn btn-danger w-75 fw-bold mr-2" id="cancelButton" style="display: none;" onclick="cancelEdit()">Batal</button>
            <button type="button" class="btn btn-primary w-75 fw-bold" id="saveButton" style="display: none;" onclick="saveData()">Simpan</button>
            <button type="button" class="btn btn-success w-75 fw-bold" id="editButton" onclick="editData()">Edit</button>
        </div>
    </div>    
</div>
<script>
    // var deletedRows = [];
    window.onload = function() {
        // Simpan nilai asli nama produk, kategori, dan foto saat halaman dimuat
        var namaProdukElement = document.getElementById('namaProduk');
        namaProdukElement.dataset.originalValue = namaProdukElement.innerHTML;

        var kategoriElement = document.getElementById('kategori');
        kategoriElement.dataset.originalValue = kategoriElement.innerHTML;

        var fotoProdukElement = document.getElementById('fotoProduk');
        fotoProdukElement.dataset.originalValue = fotoProdukElement.innerHTML;

        var deskripsiElement = document.getElementById('deskripsi');
        deskripsiElement.dataset.originalValue = deskripsiElement.innerHTML;

        // Simpan nilai asli harga dan stok untuk setiap ukuran dan warna produk saat halaman dimuat
        var hargaElements = document.querySelectorAll('.harga');
        var stockElements = document.querySelectorAll('.stock');

        hargaElements.forEach(function(element) {
            element.dataset.originalValue = element.innerHTML;
        });

        stockElements.forEach(function(element) {
            element.dataset.originalValue = element.innerHTML;
        });
    };

    function cancelEdit() {
        // Ambil semua elemen dengan kelas yang sesuai
        var namaProdukElement = document.getElementById('namaProduk');
        var kategoriElement = document.getElementById('kategori');
        var fotoProdukElement = document.getElementById('fotoProduk');
        var deskripsiElement = document.getElementById('deskripsi');

        // Kembalikan nilai nama produk, kategori, dan foto ke nilai asli
        namaProdukElement.innerHTML = namaProdukElement.dataset.originalValue;
        kategoriElement.innerHTML = kategoriElement.dataset.originalValue;
        fotoProdukElement.innerHTML = fotoProdukElement.dataset.originalValue;
        deskripsiElement.innerHTML = deskripsiElement.dataset.originalValue;

        // Ambil semua elemen dengan kelas yang sesuai untuk harga dan stok
        var hargaElements = document.querySelectorAll('.harga');
        var stockElements = document.querySelectorAll('.stock');

        // Kembalikan nilai harga dan stok ke nilai asli
        hargaElements.forEach(function(element) {
            element.innerHTML = element.dataset.originalValue;
        });

        stockElements.forEach(function(element) {
            element.innerHTML = element.dataset.originalValue;
        });

        // Sembunyikan tombol Simpan dan Batal
        document.getElementById('saveButton').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';

        // Tampilkan kembali tombol Edit
        document.getElementById('editButton').style.display = 'block';

        // Sembunyikan tombol hapus
        // var deleteButtons = document.querySelectorAll('.btn-delete');
        // deleteButtons.forEach(function(button) {
        //     button.style.display = 'none';
        // });
        // if (deletedRows.length > 0) {
        //     deletedRows.forEach(function(row) {
        //         row.style.display = 'table-row';
        //     });
        //     deletedRows = [];
        // }
    }

    function editData() {
        document.getElementById('namaProduk').innerHTML = '<input type="text" class="form-control" id="editNamaProduk" value="Jersey Futsal">';
        document.getElementById('kategori').innerHTML = '<input type="text" class="form-control" id="editKategori" value="Pakaian Olahraga Pria">';
        document.getElementById('fotoProduk').innerHTML = '<input type="text" class="form-control" id="editFotoProduk" value="Pakaian_Olahraga_Pria.jpg">';
        document.getElementById('deskripsi').innerHTML = '<input type="text" class="form-control" id="editDeskripsi" value="produk ini memiliki bahan yang berkualitas">';
        if (document.querySelector('.editHarga') === null && document.querySelector('.editStock') === null) {
            // Ambil semua elemen dengan kelas yang sesuai
            var hargaElements = document.querySelectorAll('.harga');
            var stockElements = document.querySelectorAll('.stock');

            // Tambahkan input field untuk harga dan stok pada setiap elemen
            hargaElements.forEach(function(element) {
                element.innerHTML = '<input type="text" class="form-control editHarga" value="' + element.innerHTML + '">';
            });

            stockElements.forEach(function(element) {
                element.innerHTML = '<input type="text" class="form-control editStock" value="' + element.innerHTML + '">';
            });

            // // Tampilkan tombol hapus
            // var deleteButtons = document.querySelectorAll('.btn-delete');
            // deleteButtons.forEach(function(button) {
            //     button.style.display = 'block';
            // });
        }
        // Tampilkan tombol Simpan dan Batal
        document.getElementById('saveButton').style.display = 'block';
        document.getElementById('cancelButton').style.display = 'block';

        // Sembunyikan tombol Edit
        document.getElementById('editButton').style.display = 'none';
    }

    function saveData() {
        var editedNamaProduk = document.getElementById('editNamaProduk').value;
        var editedKategori = document.getElementById('editKategori').value;
        var editedFotoProduk = document.getElementById('editFotoProduk').value;
        var editedDeskripsi = document.getElementById('editDeskripsi').value;
        var editedHargaElements = document.querySelectorAll('.editHarga');
        var editedStockElements = document.querySelectorAll('.editStock');

        document.getElementById('namaProduk').innerHTML = editedNamaProduk;
        document.getElementById('kategori').innerHTML = editedKategori;
        document.getElementById('fotoProduk').innerHTML = editedFotoProduk;
        document.getElementById('deskripsi').innerHTML = editedDeskripsi;
        // Ubah nilai pada elemen sesuai dengan nilai input field yang diedit
        editedHargaElements.forEach(function(element) {
            element.parentElement.innerHTML = element.value;
        });

        editedStockElements.forEach(function(element) {
            element.parentElement.innerHTML = element.value;
        });

        // Simpan data ke backend dengan AJAX atau cara lainnya
        // Disarankan untuk menyimpan perubahan ke server untuk menjaga konsistensi data
        // Contoh:
        // SimpanDataKeServer(editedNamaProduk, editedKategori, editedFotoProduk);

        // Sembunyikan tombol Simpan setelah selesai disimpan
        document.getElementById('saveButton').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';

        // // Sembunyikan tombol hapus
        // var deleteButtons = document.querySelectorAll('.btn-delete');
        // deleteButtons.forEach(function(button) {
        //     button.style.display = 'none';
        // });

        // Tampilkan kembali tombol Edit
        document.getElementById('editButton').style.display = 'block';
    }

    // function deleteRow(button) {
    //     var row = button.parentNode.parentNode;
    //     // Sembunyikan baris yang dihapus
    //     row.style.display = 'none';
    //     // Tambahkan baris yang dihapus ke dalam array deletedRows
    //     deletedRows.push(row);
    // }
</script>
@endsection

