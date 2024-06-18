@extends('Pelanggan.Layout.index')

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

    <form action="{{ route('pesananKonveksi.storePayment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
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
        <button type="button" class="btn btn-danger mt-2">batal</button>
        <button type="submit" class="btn btn-primary mt-2">Simpan Pembayaran</button>
    </form>
</div>

<script>
    document.getElementById('metode_pembayaran').addEventListener('change', function() {
        if (this.value !== 'COD') {
            document.getElementById('bukti_pembayaran_container').style.display = 'block';
        } else {
            document.getElementById('bukti_pembayaran_container').style.display = 'none';
        }
    });
</script>

@endsection
