@extends('Pelanggan.Layout.index')

@section('content')
<div class="container-detail">
    <div class="card p-4 mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/' . $konveksis->foto_produk) }}" class="img-fluid" alt="Product Image" style="border: 1px solid black;">
                <div class="d-flex justify-content-center align-items-center mt-4 mb-5 gap-4">
                    <div>
                        <button class="btn btn-outline-danger me-2">
                            <i class="bi bi-hand-thumbs-up"></i> Like
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-hand-thumbs-down"></i> Dislike
                        </button>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Terjual: {{ $konveksis->variasi->sum('terjual') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body text-start">
                    <h2 class="card-title">{{ $konveksis->nama_produk }}</h2>
                    <p class="card-text text-muted">Kategori: {{ $konveksis->kategori->name }}</p>
                    <h4 class="text-primary">Rp {{ number_format($hargaTertinggi, 2, ',', '.') }} - Rp {{ number_format($hargaTerendah, 2, ',', '.') }}</h4>
                    <div class="mb-4">
                        <label for="colorSelect" class="form-label">Pilih Warna:</label>
                        <select class="form-select" id="colorSelect">
                            <option selected>Pilih warna</option>
                            @foreach($variasi as $var)
                                <option value="{{ $var->warna_produk }}">{{ $var->warna_produk }}</option>
                            @endforeach
                        </select>                        
                    </div>

                    <div id="sizeStockContainer" class="mb-4">
                        <!-- Ukuran dan stok akan ditampilkan di sini berdasarkan warna yang dipilih -->
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="form-label">Kuantitas:</label>
                        <div class="input-group" style="max-width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" id="btnMinus">-</button>
                            <input type="text" class="form-control text-center" value="1" id="quantity" aria-label="Kuantitas" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                        </div>
                        <div class="mt-4">
                            <p class="fw-bold mb-0">Harga Satuan: <span id="hargaSatuan">Rp {{ number_format($hargaTertinggi, 2, ',', '.') }}</span></p>
                            <p class="fw-bold mb-0">Total Harga: <span id="totalHarga">Rp {{ number_format($hargaTertinggi, 2, ',', '.') }}</span></p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-primary me-2">Checkout</button>
                        <button class="btn btn-success">Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-2">
        <div class="card-body text-start">
            <h5 class="card-title">Deskripsi Produk</h5>
            <p class="card-text">{{ $konveksis->deskripsi }}</p>
        </div>
    </div>
</div>

<script>
    let hargaSatuan = {{ $hargaTertinggi }};
    
    // Fungsi untuk mengurangi kuantitas
    document.getElementById('btnMinus').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updateTotalHarga();
        }
    });

    // Fungsi untuk menambah kuantitas
    document.getElementById('btnPlus').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
        updateTotalHarga();
    });

    // Fungsi untuk mengupdate total harga
    function updateTotalHarga() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        var totalHarga = currentQuantity * hargaSatuan;
        document.getElementById('totalHarga').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    // Update harga satuan berdasarkan ukuran yang dipilih
    function updateHargaSatuan(harga) {
        hargaSatuan = harga;
        document.getElementById('hargaSatuan').textContent = 'Rp ' + hargaSatuan.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        updateTotalHarga();
    }

    document.getElementById('colorSelect').addEventListener('change', function() {
        var color = this.value;
        var sizeStockContainer = document.getElementById('sizeStockContainer');
        sizeStockContainer.innerHTML = '';

        // Mendapatkan variasi berdasarkan warna yang dipilih
        var selectedVariasi = @json($konveksis->variasi->groupBy('warna_produk'));

        // Jika ada variasi yang cocok dengan warna yang dipilih
        if (selectedVariasi[color]) {
            sizeStockContainer.innerHTML = `
                <label class="form-label">Pilih Ukuran:</label>
                <div class="btn-group" role="group" aria-label="Size options">
            `;

            // Menampilkan opsi ukuran dan stok untuk warna yang dipilih
            selectedVariasi[color].forEach(function(variasi) {
                sizeStockContainer.innerHTML += `
                    <input type="radio" class="btn-check" name="size" id="size${variasi.ukuran}" data-harga="${variasi.harga}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="size${variasi.ukuran}">${variasi.ukuran} (Stok: ${variasi.stock})</label>
                `;
            });

            sizeStockContainer.innerHTML += `
                </div>
            `;

            // Menambahkan event listener untuk setiap radio button
            selectedVariasi[color].forEach(function(variasi) {
                document.getElementById(`size${variasi.ukuran}`).addEventListener('change', function() {
                    updateHargaSatuan(parseFloat(this.getAttribute('data-harga')));
                });
            });
        }
    });
</script>
@endsection
