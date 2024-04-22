@extends('Admin.Layout.index')

@section('content')
<style>
    .gambar-produk {
        max-width: 200px;
        max-height: 200px;
        width: auto;
        height: auto;
    }
</style>
<div class="card mb-3">
    <div class="card-body">
        <div class="mb-3 text-primary" onclick="window.location='{{ route('tokobaju') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk">
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori:</label>
            <select class="form-select" id="kategoriTokobaju">
                <option value="pending" selected>Pakaian Pria</option>
                <option value="diproses">Pakaian Wanita</option>
                <option value="selesai">Pakaian Anak-Anak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fotoProduk" class="form-label">Upload Foto Produk Untuk Tampilan Utama:</label>
            <input type="file" class="form-control" id="fotoProduk" name="fotoProduk" accept="image/*">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarnaProduk">Tambahkan Produk</button>
        </div>
        <div id="tambahProdukButton" class="mb-3"></div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Produk:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <button type="button" class="btn btn-success">Simpan</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalWarnaProduk" tabindex="-1" aria-labelledby="modalWarnaProdukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalWarnaProdukLabel">Tambahkan Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="warna_produk" class="form-label">Warna Produk:</label>
                    <input type="text" class="form-control" id="warna_produk" name="warna_produk">
                </div>
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Pilih Ukuran:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_XXXL" value="XXXL" onchange="handleCheckboxChange('ukuran_XXXL')">
                        <label class="form-check-label" for="ukuran_XXXL">XXXL</label>
                    </div>
                    <div id="label_ukuran_XXXL" style="display: none;">
                        <label for="harga_XXXL" class="form-label">Harga XXXL:</label>
                        <input type="number" class="form-control" id="harga_XXXL" name="harga_XXXL" min="0">
                        <label for="stock_XXXL" class="form-label">Stock XXXL:</label>
                        <input type="number" class="form-control" id="stock_XXXL" name="stock_XXXL" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_XXL" value="XXL" onchange="handleCheckboxChange('ukuran_XXL')">
                        <label class="form-check-label" for="ukuran_XXL">XXL</label>
                    </div>
                    <div id="label_ukuran_XXL" style="display: none;">
                        <label for="harga_XXL" class="form-label">Harga XXL:</label>
                        <input type="number" class="form-control" id="harga_XXL" name="harga_XXL" min="0">
                        <label for="stock_XXL" class="form-label">Stock XXL:</label>
                        <input type="number" class="form-control" id="stock_XXL" name="stock_XXL" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_XL" value="XL" onchange="handleCheckboxChange('ukuran_XL')">
                        <label class="form-check-label" for="ukuran_XL">XL</label>
                    </div>
                    <div id="label_ukuran_XL" style="display: none;">
                        <label for="harga_XL" class="form-label">Harga XL:</label>
                        <input type="number" class="form-control" id="harga_XL" name="harga_XL" min="0">
                        <label for="stock_XL" class="form-label">Stock XL:</label>
                        <input type="number" class="form-control" id="stock_XL" name="stock_XL" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_L" value="L" onchange="handleCheckboxChange('ukuran_L')">
                        <label class="form-check-label" for="ukuran_L">L</label>
                    </div>
                    <div id="label_ukuran_L" style="display: none;">
                        <label for="harga_L" class="form-label">Harga L:</label>
                        <input type="number" class="form-control" id="harga_L" name="harga_L" min="0">
                        <label for="stock_L" class="form-label">Stock L:</label>
                        <input type="number" class="form-control" id="stock_L" name="stock_L" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_M" value="M" onchange="handleCheckboxChange('ukuran_M')">
                        <label class="form-check-label" for="ukuran_M">M</label>
                    </div>
                    <div id="label_ukuran_M" style="display: none;">
                        <label for="harga_M" class="form-label">Harga M:</label>
                        <input type="number" class="form-control" id="harga_M" name="harga_M" min="0">
                        <label for="stock_M" class="form-label">Stock M:</label>
                        <input type="number" class="form-control" id="stock_M" name="stock_M" min="0">
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label for="harga" class="form-label">Harga Produk:</label>
                    <input type="number" class="form-control" id="harga" name="harga" min="0" placeholder="contoh: 30.000">
                </div>
                <div class="mb-3">
                    <label for="stock_produk" class="form-label">Stock Produk:</label>
                    <input type="number" class="form-control" id="stock_produk" name="stock_produk" min="0" placeholder="contoh: 30">
                </div> --}}
                <div class="mb-3">
                    <label for="foto_produk" class="form-label">Upload Foto Produk:</label>
                    <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                {{-- <button type="button" class="btn btn-primary">Simpan</button> --}}
                <button type="button" class="btn btn-primary" onclick="simpanData()" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    function handleCheckboxChange(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        var label = document.getElementById('label_' + checkboxId);
        var hargaInput = document.getElementById('harga_' + checkboxId);
        var stockInput = document.getElementById('stock_' + checkboxId);

        if (checkbox.checked) {
            label.style.display = 'block';
            hargaInput.style.display = 'block';
            stockInput.style.display = 'block';
        } else {
            label.style.display = 'none';
            hargaInput.style.display = 'none';
            stockInput.style.display = 'none';
        }
    }
</script>
<script>
    function simpanData() {
        // Tangkap data dari modal
        var warnaProduk = document.getElementById('warna_produk').value;
        var fotoProduk = document.getElementById('foto_produk').files[0]; // Ambil file foto

        // Tangkap data ukuran, harga, dan stok
        var ukuranData = {};
        var checkboxes = document.getElementsByName('ukuran');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                var ukuran = checkbox.value;
                var harga = document.getElementById('harga_' + ukuran).value;
                var stock = document.getElementById('stock_' + ukuran).value;
                ukuranData[ukuran] = {harga: harga, stock: stock};
            }
        });

        // Simpan data ke dalam objek
        var data = {
            warnaProduk: warnaProduk,
            fotoProduk: fotoProduk, // Sisipkan file foto ke dalam objek data
            ukuranData: ukuranData
        };

        // Tampilkan data dalam card baru
        tampilkanDataCard(data);
    }

    function tampilkanDataCard(data) {
    // Buat card baru dengan data yang ditangkap
    var card = document.createElement('div');
    card.classList.add('card', 'mb-3');
    card.style.width = '100%'; // Atur lebar card menjadi 40%
    var cardBody = document.createElement('div');
    cardBody.classList.add('card-body');
    var cardContent = `
        <p class="card-text">Warna Produk: ${data.warnaProduk}</p>
        <p class="card-text">Ukuran dan Harga:</p>
        <ul>`;
    for (var ukuran in data.ukuranData) {
        cardContent += `<li>${ukuran} - Harga: ${data.ukuranData[ukuran].harga}, Stock: ${data.ukuranData[ukuran].stock}</li>`;
    }
    cardContent += `</ul>`;
    // Tampilkan gambar produk jika ada
    if (data.fotoProduk) {
        var imageURL = URL.createObjectURL(data.fotoProduk); // Buat URL objek untuk file foto
        cardContent += `<img src="${imageURL}" class="gambar-produk img-fluid" alt="Foto Produk">`; // Tampilkan gambar
    }
    cardBody.innerHTML = cardContent;

    // Tambahkan tombol close (X) ke dalam card header
    var cardHeader = document.createElement('div');
    cardHeader.classList.add('card-header', 'd-flex', 'justify-content-end'); // Menggunakan justify-content-between
    var closeButton = document.createElement('button');
    closeButton.classList.add('btn-close');
    closeButton.setAttribute('aria-label', 'Close');
    closeButton.onclick = function() {
        hapusCard(card); // Panggil fungsi hapusCard saat tombol close diklik
    };
    cardHeader.appendChild(closeButton);

    // Gabungkan card header dan card body
    card.appendChild(cardHeader);
    card.appendChild(cardBody);

    // Tentukan jumlah maksimal card per baris
    var cardPerBaris = 2; // Misalnya, dua card per baris

    // Cek apakah ada elemen div dengan class "row" yang merupakan baris
    var rows = document.querySelectorAll('.row');
    var currentRow = null;

    // Iterasi melalui baris-baris yang ada
    rows.forEach(function(row) {
        // Periksa jumlah card di dalam baris
        var cardsInRow = row.querySelectorAll('.card').length;
        if (cardsInRow < cardPerBaris) {
            // Jika masih ada slot kosong di dalam baris saat ini, gunakan baris tersebut
            currentRow = row;
        }
    });

    // Jika tidak ada baris dengan slot kosong, buat baris baru
    if (!currentRow) {
        currentRow = document.createElement('div');
        currentRow.classList.add('row');
        // Tambahkan baris baru ke dalam dokumen
        var tambahProdukButton = document.getElementById('tambahProdukButton');
        tambahProdukButton.insertAdjacentElement('afterend', currentRow);
    }

    // Buat kolom untuk card
    var col = document.createElement('div');
    col.classList.add('col-6'); // Atur lebar col menjadi 50% dari lebar baris
    col.appendChild(card);

    // Tambahkan kolom ke dalam baris
    currentRow.appendChild(col);
    }


    function hapusCard(card) {
        card.parentNode.removeChild(card);
    }
</script>
@endsection
