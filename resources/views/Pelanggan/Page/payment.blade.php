@extends('pelanggan.layout.index')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4 text-center">Pilih Metode Pembayaran</h2>

    <h3 class="mb-4 text-center">Detail Pesanan</h3>
    <div class="row mb-4">
        @foreach($pesanan as $item)
            <div class="col-md-3 mb-4 d-flex align-items-stretch">
                <div class="card h-100">
                    <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->nama_produk }}">
                    <div class="card-body text-start">
                        <h5 class="card-title mb-3 text-primary">{{ $item->nama_produk }}</h5>
                        <p class="card-text"><strong>Warna:</strong> {{ $item->warna }}</p>
                        <p class="card-text"><strong>Ukuran:</strong> {{ $item->ukuran }}</p>
                        <p class="card-text"><strong>Kuantitas:</strong> {{ $item->kuantitas }}</p>
                        <p class="card-text"><strong>Harga Satuan:</strong> <span class="text-primary">Rp {{ number_format($item->harga_satuan, 2, ',', '.') }}</span></p>
                        <p class="card-text"><strong>Total Harga:</strong> <span class="text-success">Rp {{ number_format($item->total_harga, 2, ',', '.') }}</span></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h4 class="mb-4 text-center">Total Biaya: Rp {{ number_format($total_biaya, 2, ',', '.') }}</h4>

    <form action="{{ route('pesanan.storePayment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            {{-- <label for="metode_pembayaran">Metode Pembayaran</label> --}}
            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" hidden>
                <option value="">Pilih Metode Pembayaran</option>
                @foreach($metode_transaksi as $metode)
                    <option value="{{ $metode->nama_bank }} - {{ $metode->no_rekening }}">{{ $metode->nama_bank }} - {{ $metode->no_rekening }}</option>
                @endforeach
                <option value="COD">Cash on Delivery (COD)</option>
            </select>
        </div>
        <div class="form-group" id="bukti_pembayaran_container" style="display: none;">
            <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran">
        </div>
        <input type="hidden" name="pesanan" value="{{ json_encode($pesanan) }}"> <!-- hidden input to pass pesanan items -->
        <button type="button" id="cancel-btn" class="btn btn-danger mt-2">batal</button>
        <button type="submit" class="btn btn-primary mt-2">Simpan Pembayaran</button>
    </form>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function (event) {
        event.preventDefault();
        fetch('{{ route('pesanan.storePayment') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                pesanan: document.querySelector('input[name="pesanan"]').value,
                metode_pembayaran: document.querySelector('select[name="metode_pembayaran"]').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result){
                        window.location.href = "{{ route('statusPesanan') }}";
                    },
                    onPending: function(result){
                        window.location.href = "{{ route('statusPesanan') }}";
                    },
                    onError: function(result){
                        console.error(result);
                        alert('Transaksi gagal!');
                    }
                });
            } else {
                alert('Transaksi gagal! Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan! Silakan coba lagi.');
        });
    });

    document.getElementById('metode_pembayaran').addEventListener('change', function() {
        const buktiPembayaran = document.getElementById('bukti_pembayaran');
        const buktiPembayaranContainer = document.getElementById('bukti_pembayaran_container');
        if (this.value !== 'COD') {
            buktiPembayaranContainer.style.display = 'block';
            buktiPembayaran.required = true;
        } else {
            buktiPembayaranContainer.style.display = 'none';
            buktiPembayaran.required = false;
        }
    });

    document.getElementById('cancel-btn').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pesanan Anda akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff6f00',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('payment.cancel') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('cart') }}";
                    } else {
                        Swal.fire('Error', 'Terjadi kesalahan saat menghapus pesanan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus pesanan.', 'error');
                });
            }
        });
    });
</script>

@endsection
