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
        <form action="{{ route('simpanProdukKonveksi') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
            </div>
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori:</label>
                <select class="form-select" id="kategori_id" name="kategori_id">
                    @foreach($kategoriKonveksi as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Bahan:</label>
                <input type="text" class="form-control" id="jenis" name="jenis">
            </div>
            <div class="mb-3">
                <label for="foto_produk" class="form-label">Upload Foto Contoh Produk Jadi:</label>
                <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarnaBahan">Tambahkan Variasi</button>
            </div>
            <div id="cardContainer" class="mb-3"></div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <div class="modal fade" id="modalWarnaBahan" tabindex="-1" aria-labelledby="modalWarnaProdukLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalWarnaProdukLabel">Tambahkan Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="foto_produk_modal" class="form-label">Upload Foto Bahan:</label>
                                <input type="file" class="form-control mb-3" id="foto_produk_modal" name="foto_produk_modal" accept="image/*">
                                <img id="preview_foto_produk" src="#" alt="Preview Foto Produk" class="gambar-produk" style="display: none;">
                                <div id="warnaBaju">
                                    <input type="text" class="form-control mb-3" placeholder="Warna" id="warna_produks[]" name="warna_produks[]">
                                </div>
                                <div id="stockBaju">
                                    <input type="number" class="form-control" placeholder="Stock Bahan" id="stocks[]" name="stocks[]">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="variasi_produk" class="form-label">Variasi Produk</label>
                                <div id="variasi_produk">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Ukuran" id="ukurans[]" name="ukurans[]">
                                        <input type="number" class="form-control" placeholder="Harga" id="hargas[]" name="hargas[]">
                                        <button class="btn btn-outline-secondary" type="button" id="tambah_variasi">Tambah Variasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="simpanData()" data-bs-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script> 
    document.getElementById('tambah_variasi').addEventListener('click', function() {
        var variasi_produk = document.getElementById('variasi_produk');
        var new_variasi = document.createElement('div');
        new_variasi.classList.add('input-group', 'mb-3');
        new_variasi.innerHTML = `
            <input type="text" class="form-control" placeholder="Ukuran" name="ukurans[]">
            <input type="number" class="form-control" placeholder="Harga" name="hargas[]">
            <button class="btn btn-outline-secondary" type="button" onclick="hapus_variasi(this)">Hapus</button>
        `;
        variasi_produk.appendChild(new_variasi);
    });

    function hapus_variasi(btn) {
        btn.parentNode.remove();
    }

    function displayDataInCard() {
        var namaProduk = document.getElementById('nama_produk').value;
        var deskripsiProduk = document.getElementById('deskripsi').value;
        var kategoriId = document.getElementById('kategori_id').value;
        var jenisId = document.getElementById('jenis').value;
        
        var fotoProdukInput = document.getElementById('foto_produk_modal');
        var fotoProduk = '';
        if(fotoProdukInput.files.length > 0) {
            fotoProduk = fotoProdukInput.files[0].name;
        }

        var variasiProduk = document.querySelectorAll('#warnaBaju input[name="warna_produks[]"]');
        var ukuranProduk = document.querySelectorAll('#variasi_produk input[name="ukurans[]"]');
        var hargaProduk = document.querySelectorAll('#variasi_produk input[name="hargas[]"]');
        var stockProduk = document.querySelectorAll('#stockBaju input[name="stocks[]"]');

        var cardContainer = document.createElement('div');
        cardContainer.classList.add('card', 'mb-3');
        var cardBody = document.createElement('div');
        cardBody.classList.add('card-body');

        cardBody.innerHTML = `
            
            <p class="card-text">Foto Produk: ${fotoProduk}</p>
            <img src="" alt="Foto Produk" id="foto_produk_card" class="gambar-produk">
            <h6 class="card-subtitle mb-2 text-muted">Variasi Produk:</h6>
        `;

        for (var i = 0; i < ukuranProduk.length; i++) {
            var variation = `
                <p class="card-text">Warna: ${variasiProduk[0].value}</p>
                <p class="card-text">Ukuran: ${ukuranProduk[i].value}</p>
                <p class="card-text">Harga: ${hargaProduk[i].value}</p>
                <p class="card-text">Stock: ${stockProduk[0].value}</p>
                <input type="text" value="${variasiProduk[0].value}" class="form-control invisible" placeholder="Warna" id="warna_produk[]" name="warna_produk[]">
                <input type="text" value="${ukuranProduk[i].value}" class="form-control invisible" placeholder="Ukuran" id="ukuran[]" name="ukuran[]">
                <input type="number" value="${hargaProduk[i].value}" class="form-control invisible" placeholder="Harga" id="harga[]" name="harga[]">
                <input type="number" value="${stockProduk[0].value}" class="form-control invisible" placeholder="Stock" id="stock[]" name="stock[]">
            `;
            cardBody.innerHTML += variation;
        }

        cardContainer.appendChild(cardBody);

        var cardDiv = document.getElementById('cardContainer');
        cardDiv.appendChild(cardContainer);

        var fotoProdukCard = cardBody.querySelector('#foto_produk_card');
        if (fotoProduk) {
            fotoProdukCard.src = URL.createObjectURL(fotoProdukInput.files[0]);
        } else {
            fotoProdukCard.style.display = 'none';
        }
    }

    document.getElementById('foto_produk_modal').addEventListener('change', function(event) {
        var fotoProduk = document.getElementById('preview_foto_produk');
        fotoProduk.src = URL.createObjectURL(event.target.files[0]);
        fotoProduk.style.display = 'block';
    });
    function clearFormInputs() {
        document.getElementById('nama_produk').value = '';
        document.getElementById('deskripsi').value = '';
        document.getElementById('kategori_id').value = '';
        document.getElementById('foto_produk').value = '';
        document.getElementById('jenis').value = '';
        var variasiProduk = document.querySelectorAll('#variasi_produk input[name="warna_produk[]"]');
        variasiProduk.forEach(input => input.value = '');
        var ukuranProduk = document.querySelectorAll('#variasi_produk input[name="ukuran[]"]');
        ukuranProduk.forEach(input => input.value = '');
        var hargaProduk = document.querySelectorAll('#variasi_produk input[name="harga[]"]');
        hargaProduk.forEach(input => input.value = '');
        var stockProduk = document.querySelectorAll('#variasi_produk input[name="stock[]"]');
        stockProduk.forEach(input => input.value = '');
    }

    function simpanData() {
        displayDataInCard();
    }
</script>
@endsection
