@extends('Admin.Layout.index')

@section('content')
<style>
    .gambar-produk {
        max-width: 200px;
        max-height: 200px;
        width: auto;
        height: auto;
    }
    .modal-xl-custom {
        max-width: 85%; 
    }
</style>
<div class="card mb-3">
    <div class="card-body">
        <div class="mb-3 text-primary" onclick="window.location='{{ route('tokobaju') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('simpanProduk') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
            </div>
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori:</label>
                <select class="form-select" id="kategori_id" name="kategori_id">
                    @foreach($kategoriTokobaju as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
            </div>
            <div class="mb-3">
                <label for="foto_produk" class="form-label">Upload Foto Produk Untuk Tampilan Utama:</label>
                <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarnaProduk">Tambahkan Produk</button>
            </div>
            <div id="cardContainer" class="mb-3"></div>
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label">Deskripsi Produk:</label>
                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <div class="modal fade" id="modalWarnaProduk" tabindex="-1" aria-labelledby="modalWarnaProdukLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl-custom">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalWarnaProdukLabel">Tambahkan Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="variasi_produk" class="form-label">Variasi Produk</label>
                                <div id="variasi_produk">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Warna" name="warna_produks[]">
                                        <input type="text" class="form-control" placeholder="Ukuran" name="ukurans[]">
                                        <input type="number" class="form-control" placeholder="Harga" name="hargas[]">
                                        <input type="number" class="form-control" placeholder="Stock" name="stocks[]">
                                        <input type="file" class="form-control" name="foto_produk_modals[]" accept="image/*">
                                        <button class="btn btn-outline-secondary" type="button" id="tambah_variasi">Tambah Variasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="displayDataInCard()" data-bs-dismiss="modal">Simpan</button>
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
            <input type="text" class="form-control" placeholder="Warna" name="warna_produks[]">
            <input type="text" class="form-control" placeholder="Ukuran" name="ukurans[]">
            <input type="number" class="form-control" placeholder="Harga" name="hargas[]">
            <input type="number" class="form-control" placeholder="Stock" name="stocks[]">
            <input type="file" class="form-control" name="foto_produk_modals[]" accept="image/*">
            <button class="btn btn-outline-secondary" type="button" onclick="hapus_variasi(this)">Hapus</button>
        `;
        variasi_produk.appendChild(new_variasi);
    });

    function hapus_variasi(btn) {
        btn.parentNode.remove();
    }

    function displayDataInCard() {
        var cardContainer = document.getElementById('cardContainer');

        var variasi_produk = document.getElementById('variasi_produk');
        var variasi_groups = variasi_produk.querySelectorAll('.input-group');

        variasi_groups.forEach((group, index) => {
            var warna = group.querySelector('input[name="warna_produks[]"]').value;
            var ukuran = group.querySelector('input[name="ukurans[]"]').value;
            var harga = group.querySelector('input[name="hargas[]"]').value;
            var stock = group.querySelector('input[name="stocks[]"]').value;
            var foto_input = group.querySelector('input[name="foto_produk_modals[]"]');

            var foto_produk = foto_input.files.length > 0 ? foto_input.files[0] : null;
            var foto_url = foto_produk ? URL.createObjectURL(foto_produk) : '';

            var card = document.createElement('div');
            card.classList.add('card', 'mb-3');
            card.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">Variasi Produk ${index + 1}</h5>
                    <p class="card-text">Warna: ${warna}</p>
                    <p class="card-text">Ukuran: ${ukuran}</p>
                    <p class="card-text">Harga: ${harga}</p>
                    <p class="card-text">Stock: ${stock}</p>
                    ${foto_url ? `<img src="${foto_url}" class="gambar-produk" alt="Foto Produk">` : ''}
                </div>
            `;
            cardContainer.appendChild(card);
        });
    }
</script>
@endsection
