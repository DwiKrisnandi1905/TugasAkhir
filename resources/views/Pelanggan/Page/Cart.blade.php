@extends('pelanggan.layout.index')

@section('content')

<style>
    .card {
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .card-body {
        flex: 1;
        background: #f9f9f9;
    }
    .card-img-top {
        border: 1px solid #ddd;
        padding: 5px;
        background: #fff;
        border-radius: 10px;
    }
    .select-item-container {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
        display: flex;
        align-items: center;
    }
    .select-item-container input[type="checkbox"] {
        display: none;
    }
    .select-item-container label {
        width: 20px;
        height: 20px;
        border-radius: 5px;
        display: block;
        background-color: #fff;
        border: 2px solid #ddd;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .select-item-container label::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        background: #ff6f00;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: all 0.3s ease;
        border-radius: 2px;
    }
    .select-item-container input[type="checkbox"]:checked + label {
        border-color: #ff6f00;
        background-color: #fff;
    }
    .select-item-container input[type="checkbox"]:checked + label::after {
        transform: translate(-50%, -50%) scale(1);
    }
    .black {
        font-weight: bold;
        color: #333;
    }
    .card-text {
        font-size: 14px;
        text-align: left; /* Align text to the left */
    }
    .text-primary {
        font-size: 1.2em;
        font-weight: bold;
    }
    .text-success {
        font-size: 1.2em;
        font-weight: bold;
    }
    .btn {
        margin: 5px 0;
        width: 100%;
    }

    .swal2-popup {
        border-radius: 10px !important;
        background: #f7f7f7 !important;
        padding: 20px !important;
        width: 500px;
    }
    .swal2-title {
        font-size: 1.5rem !important;
        font-weight: bold !important;
        margin-bottom: 20px !important;
        text-align: center !important;
    }
    .swal2-html-container {
        font-size: 1rem !important;
        text-align: left !important; 
        list-style-type: none !important; 
    }
    .swal2-confirm {
        background-color: #ff6f00 !important;
        border: none !important;
        border-radius: 5px !important;
        color: #fff !important;
        font-size: 1rem !important;
        padding: 10px 20px !important;
    }
    .swal2-cancel {
        background-color: #d33 !important;
        border: none !important;
        border-radius: 5px !important;
        color: #fff !important;
        font-size: 1rem !important;
        padding: 10px 20px !important;
    }
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-konveksi {
        background-color: #ff6f00;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }
</style>

<div class="container mt-4">
    <div class="header-container">
        <h2 class="mb-4 text-center">Keranjang Tokobaju</h2>
        <a href="{{ route('cartKonveksi') }}" class="btn-konveksi loading">Cart Konveksi</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($cart->count() > 0)
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    @foreach($cart as $item)
                        <div class="col-md-3 mb-4 d-flex align-items-stretch">
                            <div class="card h-100">
                                <div class="select-item-container">
                                    <input type="checkbox" class="select-item" id="select-{{ $item->id }}" data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}" data-warna="{{ $item->warna }}" data-ukuran="{{ $item->ukuran }}" data-kuantitas="{{ $item->kuantitas }}" data-hargasatuan="{{ $item->harga_satuan }}" data-totalharga="{{ $item->total_harga }}" data-image="{{ $item->image }}" data-produk="{{ $item->variasi_id }}">
                                    <label for="select-{{ $item->id }}"></label>
                                </div> 
                                <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->nama_produk }}">
                                <div class="card-body text-start">
                                    <p class="card-text"><strong>id:</strong> {{ $item->variasi_id }}</p>
                                    <h5 class="card-title mb-3 text-primary">{{ $item->nama_produk }}</h5>
                                    <p class="card-text"><strong>Warna:</strong> {{ $item->warna }}</p>
                                    <p class="card-text"><strong>Ukuran:</strong> {{ $item->ukuran }}</p>
                                    <p class="card-text"><strong>Kuantitas:</strong> {{ $item->kuantitas }}</p>
                                    <p class="card-text"><strong>Harga Satuan:</strong> <span class="text-primary">Rp {{ number_format($item->harga_satuan, 2, ',', '.') }}</span></p>
                                    <p class="card-text"><strong>Total Harga:</strong> <span class="text-success">Rp {{ number_format($item->total_harga, 2, ',', '.') }}</span></p>
                                </div>
                                <div class="card-footer text-center">
                                    <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mt-4">
                    <button class="btn btn-success" id="checkout-btn">Lanjutkan ke Pembayaran</button>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            Keranjang belanja kosong.
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Item ini akan dihapus dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff6f00',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    document.getElementById('checkout-btn').addEventListener('click', function() {
    let selectedItems = [];
    document.querySelectorAll('.select-item:checked').forEach(item => {
        selectedItems.push({
            produk_id: item.dataset.produk,
            id: item.dataset.id,
            nama: item.dataset.nama,
            warna: item.dataset.warna,
            ukuran: item.dataset.ukuran,
            kuantitas: item.dataset.kuantitas,
            hargaSatuan: item.dataset.hargasatuan,
            totalHarga: item.dataset.totalharga,
            image: item.dataset.image
        });
    });

    if (selectedItems.length > 0) {
        console.log(selectedItems);
        let htmlContent = '<ul>'; 
        selectedItems.forEach(item => {
            htmlContent += `
            <li style="margin-bottom: 10px;">
                <img src="{{ asset('images') }}/${item.image}" alt="${item.nama}" style="width: 50px; height: 50px; margin-right: 10px;">
                <strong>${item.nama}</strong> - Warna: ${item.warna}, Ukuran: ${item.ukuran}, Kuantitas: ${item.kuantitas}, 
                Harga Satuan: Rp ${parseFloat(item.hargaSatuan).toLocaleString('id-ID', {minimumFractionDigits: 2})}, 
                Total Harga: Rp ${parseFloat(item.totalHarga).toLocaleString('id-ID', {minimumFractionDigits: 2})}
            </li>`;
        });
        htmlContent += '</ul>';

        Swal.fire({
            title: 'Konfirmasi Pesanan',
            html: htmlContent,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#ff6f00',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'swal2-popup',
                title: 'swal2-title',
                htmlContainer: 'swal2-html-container',
                confirmButton: 'swal2-confirm',
                cancelButton: 'swal2-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(selectedItems);
                fetch("{{ route('pesanan.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ items: selectedItems })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('alamat.form') }}";
                    } else {
                        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan pesanan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan saat menyimpan pesanan.', 'error');
                });
            }
        });
    } else {
        Swal.fire({
            title: 'Tidak ada item yang dipilih',
            text: "Silakan pilih item untuk melanjutkan ke pembayaran.",
            icon: 'warning',
            confirmButtonColor: '#ff6f00',
            confirmButtonText: 'OK'
        });
    }
});
</script>
@endsection
