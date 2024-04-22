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
        <div class="mb-3 text-primary" onclick="window.location='{{ route('konveksi') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk">
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori:</label>
            <select class="form-select" id="kategoriKonveksi">
                <option value="pending" selected>Jersey Futsal</option>
                <option value="diproses">Jersey Badminton</option>
                <option value="selesai">Jersey Sepak Bola</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Bahan:</label>
            <input type="text" class="form-control" id="jenis" name="jenis">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Persatuan:</label>
            <input type="number" class="form-control" id="harga" name="harga" min="0" placeholder="contoh: 30.000">
        </div>
        <div class="mb-3">
            <label for="fotoBahan" class="form-label">Upload Foto Contoh Produk Jadi:</label>
            <input type="file" class="form-control" id="fotoBahan" name="fotoBahan" accept="image/*">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarnaBahan">Tambahkan Warna Bahan</button>
        </div>
        <div id="tambahProdukButton" class="mb-3"></div>
        <div class="mb-3">
            <label for="ukuran" class="form-label">Pilih Ukuran:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_xxxl" value="xxxl">
                <label class="form-check-label" for="ukuran_xxxl">XXXL</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_xxl" value="xxl">
                <label class="form-check-label" for="ukuran_xxl">XXL</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_XL" value="XL">
                <label class="form-check-label" for="ukuran_XL">XL</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_L" value="L">
                <label class="form-check-label" for="ukuran_L">L</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_M" value="M">
                <label class="form-check-label" for="ukuran_M">M</label>
            </div>
        </div>
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
<div class="modal fade" id="modalWarnaBahan" tabindex="-1" aria-labelledby="modalWarnaBahanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalWarnaBahanLabel">Tambahkan Warna Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="warna_bahan" class="form-label">Warna Bahan:</label>
                    <input type="text" class="form-control" id="warna_bahan" name="warna_bahan">
                </div>
                <div class="mb-3">
                    <label for="stock_bahan" class="form-label">Stock Bahan:</label>
                    <input type="number" class="form-control" id="stock_produk" name="stock_produk" min="0" placeholder="contoh: 30">
                </div>
                <div class="mb-3">
                    <label for="foto_bahan" class="form-label">Upload Foto Bahan Berdasarkan Warna:</label>
                    <input type="file" class="form-control" id="foto_bahan" name="foto_bahan" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="simpanDataBahan()" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    function simpanDataBahan() {
        // Tangkap data dari modal
        var warnaBahan = document.getElementById('warna_bahan').value;
        var stockBahan = document.getElementById('stock_produk').value;
        var fotoBahan = document.getElementById('foto_bahan').files[0]; // Ambil file foto

        // Simpan data ke dalam objek
        var data = {
            warnaBahan: warnaBahan,
            stockBahan: stockBahan,
            fotoBahan: fotoBahan // Sisipkan file foto ke dalam objek data
        };

        // Tampilkan data dalam card baru
        tampilkanDataBahanCard(data);
    }

    function tampilkanDataBahanCard(data) {
        // Buat card baru dengan data yang ditangkap
        var card = document.createElement('div');
        card.classList.add('card', 'mb-3');
        card.style.width = '100%'; // Atur lebar card menjadi 100%
        var cardBody = document.createElement('div');
        cardBody.classList.add('card-body');
        var cardContent = `
            <p class="card-text">Warna Bahan: ${data.warnaBahan}</p>
            <p class="card-text">Stock Bahan: ${data.stockBahan}</p>`;
        // Tampilkan gambar produk jika ada
        if (data.fotoBahan) {
            var imageURL = URL.createObjectURL(data.fotoBahan); // Buat URL objek untuk file foto
            cardContent += `<img src="${imageURL}" class="gambar-produk img-fluid" alt="Foto Bahan">`; // Tampilkan gambar
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
