@extends('pelanggan.layout.index')

@section('content')
<style>
    .modal-content {
        background: linear-gradient(45deg, #ff7043, #ff8a50); 
        border: 1px solid #ff9800; 
        color: #ffffff;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
    .modal-header, .modal-footer {
        background-color: transparent;
        border-bottom: none;
        padding: 10px 20px; 
    }
    .modal-title {
        font-weight: bold;
        margin: 0;
    }
    .btn-close {
        color: #ffffff; 
        opacity: 1;
    }
    .modal-body p {
        margin-bottom: 0.5rem;
    }
    .modal-body p strong {
        color: #ffffff; 
    }
    .btn-secondary, .btn-primary {
        background-color: #ff7043;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-secondary:hover, .btn-primary:hover {
        background-color: #d84315;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .btn-primary {
        background-color: #d84315; 
    }
    .btn-primary:focus {
        box-shadow: 0 0 0 0.25rem rgba(216, 67, 21, 0.5); 
    }
    .modal-dialog {
        min-height: 100vh;
    }
    .thumbnail {
        max-width: 50px;
        max-height: 50px;
        margin: 5px;
        border: 1px solid #ddd;
        cursor: pointer;
    }

    html, body {
        user-select: none; /* Disable text selection */
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .no-screenshot {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        z-index: 9999;
        display: none;
    }
</style>
<div class="container-detail">
    <div class="d-flex">
        <div class="mb-3 text-primary loading" onclick="window.location='{{ route('konveksii') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>
    </div>
    <div class="card p-4 mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/' . $konveksi->foto_produk) }}" class="img-fluid" alt="Product Image" style="border: 1px solid black;">
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
                        <p class="text-muted mb-0">Terjual: {{ $totalTerjual }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body text-start">
                    <h2 class="card-title fw-bold">{{ $konveksi->nama_produk }}</h2>
                    <p class="card-text text-muted">Kategori: {{ $konveksi->kategori->name }}</p>
                    <h4 class="text-primary">Rp {{ number_format($hargaTertinggi, 2, ',', '.') }} - Rp {{ number_format($hargaTerendah, 2, ',', '.') }}</h4>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-4">
                                <label for="colorSelect" class="form-label">Pilih Warna:</label>
                                <select class="form-select" id="colorSelect">
                                    <option selected>Pilih warna</option>
                                    @foreach($konveksi->variasi->groupBy('warna_produk') as $warna => $variasi)
                                        <option value="{{ $warna }}">{{ $warna }}</option>
                                    @endforeach
                                </select>
                                <div class="d-flex flex-wrap mt-4">
                                    @php
                                        $warnaDitampilkan = [];
                                    @endphp
                                    @foreach($konveksi->variasi as $variasi)
                                        @if($variasi->foto_produk_modal && !isset($warnaDitampilkan[$variasi->warna_produk]))
                                        <img src="{{ asset('images/' . $variasi->foto_produk_modal) }}" class="thumbnail" alt="Variasi Foto Produk" data-bs-toggle="modal" data-bs-target="#modal{{$variasi->id}}">
                                            @php
                                                $warnaDitampilkan[$variasi->warna_produk] = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                </div>   
                                @foreach($konveksi->variasi as $variasi)
                                <div class="modal fade" id="modal{{$variasi->id}}" tabindex="-1" aria-labelledby="modal{{$variasi->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-sm d-flex justify-content-center align-items-center">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ asset('images/' . $variasi->foto_produk_modal) }}" class="img-fluid" alt="Variasi Foto Produk">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach                     
                            </div>
                            <div id="sizeStockContainer" class="mb-4"></div>
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
                        </div>
                        <div class="col-12 col-lg-6 align-content-center">
                            <div class="custom-card text-center text-white" style="background-color:#ff5722; border-radius: 10px;">
                                <h5>Custom Nama</h5>
                                <p>Contact: 098765432109</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-primary me-2" id="checkoutButton" data-bs-toggle="modal" data-bs-target="#checkoutModal">Keranjang</button>
                    </div>
                    <div class="col-md-4 mt-4">
                        {{-- <h4>QR Code</h4> --}}
                        <div id="qrCodeContainer" class="text-center mb-4">
                            @php
                                // Data yang akan digunakan untuk QR code
                                $qrData = [
                                    'judul' => 'Alveen Clothing',
                                    'nama_produk' => $konveksi->nama_produk,
                                    'foto_produk' => asset('images/' . $konveksi->foto_produk),
                                    'nft_token_id' => $konveksi->nft_token_id
                                    // Tambahkan data lain yang diperlukan
                                ];
                    
                                // URL untuk menampilkan QR code
                                $qrCodeUrl = route('displayQRCodeDataKonveksi', ['data' => json_encode($qrData)]);
                            @endphp
                    
                            {!! QrCode::size(200)->generate($qrCodeUrl) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-2">
        <div class="card-body text-start">
            <h5 class="card-title">Deskripsi Produk</h5>
            <p class="card-text">{{ $konveksi->deskripsi }}</p>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p><strong>Warna:</strong> <span id="modalWarna"></span></p>
                <p><strong>Ukuran:</strong> <span id="modalUkuran"></span></p>
                <p><strong>Kuantitas:</strong> <span id="modalKuantitas"></span></p>
                <p><strong>Total Harga:</strong> <span id="modalTotalHarga"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary loading">Keranjang</button>
            </div>
        </div>
    </div>
</div>
<div class="no-screenshot" id="noScreenshotOverlay"></div>

<script>
    let hargaSatuan = {{ $hargaTertinggi }};
    let selectedImage = '';
    let selectedS = '';
    let selectedC = '';

    // Function to reduce quantity
    document.getElementById('btnMinus').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updateTotalHarga();
        }
    });

    // Function to increase quantity
    document.getElementById('btnPlus').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        var maxQuantity = parseInt(quantityInput.getAttribute('max'));
        if (currentQuantity < maxQuantity) {
            quantityInput.value = currentQuantity + 1;
            updateTotalHarga();
        }
    });

    // Function to update total price
    function updateTotalHarga() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        var totalHarga = currentQuantity * hargaSatuan;
        document.getElementById('totalHarga').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    // Update unit price based on selected size
    function updateHargaSatuan(harga) {
        hargaSatuan = harga;
        document.getElementById('hargaSatuan').textContent = 'Rp ' + hargaSatuan.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        updateTotalHarga();
    }

    document.getElementById('colorSelect').addEventListener('change', function() {
        var color = this.value;
        var sizeStockContainer = document.getElementById('sizeStockContainer');
        sizeStockContainer.innerHTML = '';

        // Get variations based on selected color
        var selectedVariasi = @json($konveksi->variasi->groupBy('warna_produk'));
        
        // If variations match the selected color
        if (selectedVariasi[color]) {

            var selectedVarian = selectedVariasi[color][0]; // Ambil variasi pertama sebagai contoh
            selectedImage = selectedVarian.foto_produk_modal;
            
            // Update gambar utama produk
            document.querySelector('.container-detail img.img-fluid').src = '{{ asset('images') }}/' + selectedImage;

            sizeStockContainer.innerHTML = `
                <label class="form-label">Pilih Ukuran:</label>
                <div class="btn-group" role="group" aria-label="Size options">
            `;

            // Display size and stock options for selected color
            selectedVariasi[color].forEach(function(variasi) {
                sizeStockContainer.innerHTML += `
                    <input type="radio" class="btn-check" name="size" id="size${variasi.ukuran}" data-harga="${variasi.harga}" data-stock="${variasi.stock}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="size${variasi.ukuran}" data-size="${variasi.ukuran}">${variasi.ukuran} (Stok: ${variasi.stock})</label>
                `;
            });

            sizeStockContainer.innerHTML += `
                </div>
            `;

            // Add event listener for each radio button
            selectedVariasi[color].forEach(function(variasi) {
                document.getElementById(`size${variasi.ukuran}`).addEventListener('change', function() {
                    updateHargaSatuan(parseFloat(this.getAttribute('data-harga')));
                    document.getElementById('quantity').value = 1;
                    var maxStock = parseInt(this.getAttribute('data-stock'));
                    document.getElementById('quantity').setAttribute('max', maxStock);
                    if (maxStock === 0) {
                        alert('Ukuran ini sedang tidak tersedia.');
                        document.getElementById('quantity').value = 0;
                    }
                    updateTotalHarga();
                });
            });
        }
    });
    document.getElementById('quantity').addEventListener('input', function() {
        var maxQuantity = parseInt(this.getAttribute('max'));
        var currentQuantity = parseInt(this.value);
        if (currentQuantity > maxQuantity) {
            this.value = maxQuantity;
        }
        updateTotalHarga();
    });

    document.getElementById('checkoutButton').addEventListener('click', function() {
        var selectedColor = document.getElementById('colorSelect').value;
        var selectedSize = document.querySelector('input[name="size"]:checked');
        var quantity = document.getElementById('quantity').value;
        var totalHarga = document.getElementById('totalHarga').textContent;

        if (selectedColor === 'Pilih warna' || !selectedSize) {
            alert('Silakan pilih warna dan ukuran!');
            return;
        }

        document.getElementById('modalWarna').textContent = selectedColor;
        document.getElementById('modalUkuran').textContent = selectedSize.labels[0].dataset.size;
        selectedS = selectedSize.labels[0].dataset.size;
        selectedC = selectedColor;
        document.getElementById('modalKuantitas').textContent = quantity;
        document.getElementById('modalTotalHarga').textContent = totalHarga;
    });

     // Handle form submission when the modal "Keranjang" button is clicked
     document.querySelector('#checkoutModal .btn-primary').addEventListener('click', function() {
        // Get variations based on selected color
        var selectedVariasi = @json($konveksi->variasi);
        var selectedVarian = selectedVariasi.find(function(variasi) {
            return variasi.warna_produk === selectedC && variasi.ukuran === selectedS;
        });

        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cartKonveksi.store") }}';

        var inputs = [
            { name: 'konveksi_id', value: '{{ $konveksi->id }}' },
            { name: 'variasi_id', value: selectedVarian.id },
            { name: 'nama_produk', value: '{{ $konveksi->nama_produk }}' },
            { name: 'warna', value: document.getElementById('modalWarna').textContent },
            { name: 'ukuran', value: document.getElementById('modalUkuran').textContent },
            { name: 'kuantitas', value: document.getElementById('modalKuantitas').textContent },
            { name: 'harga_satuan', value: hargaSatuan },
            { name: 'total_harga', value: parseFloat(document.getElementById('modalTotalHarga').textContent.replace('Rp ', '').replace(/\./g, '').replace(',', '.')) },
            { name: 'image', value: selectedImage },
            { name: 'kategori', value: '{{ $konveksi->kategori->name }}' },
            { name: '_token', value: '{{ csrf_token() }}' }
        ];

        inputs.forEach(function(input) {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = input.name;
            hiddenInput.value = input.value;
            form.appendChild(hiddenInput);
        });

        document.body.appendChild(form);
        form.submit();
    });

    // Disable Print Screen Key
    document.addEventListener('keyup', function (e) {
        if (e.key === 'PrintScreen') {
            navigator.clipboard.writeText(''); // Clear clipboard
            alert('Tangkapan layar tidak diizinkan dihalaman ini.');
        }
    });

    // Disable Ctrl+P (Print)
    document.addEventListener('keydown', function (e) {
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            alert('Tangkapan layar tidak diizinkan dihalaman ini.');
        }
    });

    // Show overlay when page visibility changes
    document.addEventListener('visibilitychange', function () {
        if (document.visibilityState === 'hidden') {
            document.getElementById('noScreenshotOverlay').style.display = 'block';
        } else {
            document.getElementById('noScreenshotOverlay').style.display = 'none';
        }
    });
</script>
@endsection
