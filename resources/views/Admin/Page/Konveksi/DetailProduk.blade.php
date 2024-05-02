@extends('Admin.Layout.index')

@section('content')
<div class="card" id="detailKonveksi">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="text-primary" onclick="window.location='{{ route('konveksi') }}';">
                <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
            </div>
        </div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th scope="row" class="col-4">Id Produk</th>
            <td id="idProduk">{{ $konveksis->id }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Tanggal Masuk</th>
            <td id="kategori">{{ $konveksis->tanggal_masuk }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Nama Produk</th>
            <td id="namaProduk">{{ $konveksis->nama_produk }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Kategori</th>
            <td id="kategori">{{ $konveksis->kategori->name }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Jenis Bahan</th>
            <td id="jenisBahan">{{ $konveksis->jenis }}</td>
          </tr>
          {{-- <tr>
            <th scope="row" class="col-4">Ukuran Tersedia</th>
            <td>XXXL, XXL, XL, L, M</td>
          </tr> --}}
          {{-- <tr>
            <th scope="row" class="col-4">Harga Persatuan</th>
            <td id="harga">Rp 80.000,00</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Harga Persatuan(Khusus XXXL dan XXL)</th>
            <td id="hargaKhusus">Rp 90.000,00</td>
          </tr> --}}
          <tr>
            <th scope="row" class="col-4">Upload Foto Contoh Produk Jadi</th>
            <td>Pakaian_Olahraga_Pria.jpg</td>
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
            <td id="deskripsi">{{ $konveksis->deskripsi }}</td>
          </tr>
        </tbody>
      </table>
      <h4>Detail warna dan ukuran bahan tersedia</h4>
      <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2" class="text-center">Hitam</th>
            </tr>
        </thead>            
        <thead>
        <tr>
            <th scope="col" class="col-5">Stock</th>
            <th scope="col">Gambar</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="stok">30</td>
            <td class="gambar">Gambar.jpg</td>
        </tr>
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2" class="text-center">Merah</th>
            </tr>
        </thead>            
        <thead>
        <tr>
            <th scope="col" class="col-5">Stock</th>
            <th scope="col">Gambar</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="stok">30</td>
            <td class="gambar">Gambar.jpg</td>
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
  window.onload = function() {
    // Simpan nilai asli nama produk, kategori, jenis bahan, harga, dan deskripsi saat halaman dimuat
    var namaProdukElement = document.getElementById('namaProduk');
    namaProdukElement.dataset.originalValue = namaProdukElement.innerHTML;

    var kategoriElement = document.getElementById('kategori');
    kategoriElement.dataset.originalValue = kategoriElement.innerHTML;

    var jenisBahanElement = document.getElementById('jenisBahan');
    jenisBahanElement.dataset.originalValue = jenisBahanElement.innerHTML;

    var hargaElement = document.getElementById('harga');
    hargaElement.dataset.originalValue = hargaElement.innerHTML;

    var hargaKhususElement = document.getElementById('hargaKhusus');
    hargaKhususElement.dataset.originalValue = hargaKhususElement.innerHTML;

    var deskripsiElement = document.getElementById('deskripsi');
    deskripsiElement.dataset.originalValue = deskripsiElement.innerHTML;

    // Simpan nilai asli stok dan gambar untuk setiap warna saat halaman dimuat
    var stokElements = document.querySelectorAll('.stok');
    var gambarElements = document.querySelectorAll('.gambar');

    stokElements.forEach(function(element) {
        element.dataset.originalValue = element.innerHTML;
    });

    gambarElements.forEach(function(element) {
        element.dataset.originalValue = element.innerHTML;
    });
};

function cancelEdit() {
    // Ambil semua elemen dengan kelas yang sesuai
    var namaProdukElement = document.getElementById('namaProduk');
    var kategoriElement = document.getElementById('kategori');
    var jenisBahanElement = document.getElementById('jenisBahan');
    var hargaElement = document.getElementById('harga');
    var hargaKhususElement = document.getElementById('hargaKhusus');
    var deskripsiElement = document.getElementById('deskripsi');

    // Kembalikan nilai nama produk, kategori, jenis bahan, harga, harga khusus, dan deskripsi ke nilai asli
    namaProdukElement.innerHTML = namaProdukElement.dataset.originalValue;
    kategoriElement.innerHTML = kategoriElement.dataset.originalValue;
    jenisBahanElement.innerHTML = jenisBahanElement.dataset.originalValue;
    hargaElement.innerHTML = hargaElement.dataset.originalValue;
    hargaKhususElement.innerHTML = hargaKhususElement.dataset.originalValue;
    deskripsiElement.innerHTML = deskripsiElement.dataset.originalValue;

    // Ambil semua elemen dengan kelas yang sesuai untuk stok dan gambar
    var stokElements = document.querySelectorAll('.stok');
    var gambarElements = document.querySelectorAll('.gambar');

    // Kembalikan nilai stok dan gambar ke nilai asli
    stokElements.forEach(function(element) {
        element.innerHTML = element.dataset.originalValue;
    });

    gambarElements.forEach(function(element) {
        element.innerHTML = element.dataset.originalValue;
    });

    // Sembunyikan tombol Simpan dan Batal
    document.getElementById('saveButton').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';

    // Tampilkan kembali tombol Edit
    document.getElementById('editButton').style.display = 'block';
}

function editData() {
    document.getElementById('namaProduk').innerHTML = '<input type="text" class="form-control" id="editNamaProduk" value="Jersey Futsal">';
    document.getElementById('kategori').innerHTML = '<input type="text" class="form-control" id="editKategori" value="Pakaian Olahraga Pria">';
    document.getElementById('jenisBahan').innerHTML = '<input type="text" class="form-control" id="editJenisBahan" value="Katun">';
    document.getElementById('harga').innerHTML = '<input type="text" class="form-control" id="editHarga" value="Rp 80.000,00">';
    document.getElementById('hargaKhusus').innerHTML = '<input type="text" class="form-control" id="editHargaKhusus" value="Rp 90.000,00">';
    document.getElementById('deskripsi').innerHTML = '<input type="text" class="form-control" id="editDeskripsi" value="produk ini memiliki bahan yang berkualitas">';
    if (document.querySelector('.editStok') === null && document.querySelector('.editGambar') === null) {
        // Ambil semua elemen dengan kelas yang sesuai
        var stokElements = document.querySelectorAll('.stok');
        var gambarElements = document.querySelectorAll('.gambar');

        // Tambahkan input field untuk stok dan gambar pada setiap elemen
        stokElements.forEach(function(element) {
            var value = element.innerHTML;
            element.innerHTML = '';
            var input = document.createElement('input');
            input.type = 'text';
            input.classList.add('form-control', 'editStok');
            input.value = value;
            element.appendChild(input);
        });

        gambarElements.forEach(function(element) {
            var value = element.innerHTML;
            element.innerHTML = '';
            var input = document.createElement('input');
            input.type = 'text';
            input.classList.add('form-control', 'editGambar');
            input.value = value;
            element.appendChild(input);
        });
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
    var editedJenisBahan = document.getElementById('editJenisBahan').value;
    var editedHarga = document.getElementById('editHarga').value;
    var editedHargaKhusus = document.getElementById('editHargaKhusus').value;
    var editedDeskripsi = document.getElementById('editDeskripsi').value;
    var editedStokElements = document.querySelectorAll('.editStok');
    var editedGambarElements = document.querySelectorAll('.editGambar');

    document.getElementById('namaProduk').innerHTML = editedNamaProduk;
    document.getElementById('kategori').innerHTML = editedKategori;
    document.getElementById('jenisBahan').innerHTML = editedJenisBahan;
    document.getElementById('harga').innerHTML = editedHarga;
    document.getElementById('hargaKhusus').innerHTML = editedHargaKhusus;
    document.getElementById('deskripsi').innerHTML = editedDeskripsi;

    // Ubah nilai pada elemen sesuai dengan nilai input field yang diedit
    editedStokElements.forEach(function(element) {
        element.parentElement.innerHTML = element.value;
    });

    editedGambarElements.forEach(function(element) {
        element.parentElement.innerHTML = element.value;
    });

    // Sembunyikan tombol Simpan setelah selesai disimpan
    document.getElementById('saveButton').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';

    // Tampilkan kembali tombol Edit
    document.getElementById('editButton').style.display = 'block';
}

</script>
@endsection