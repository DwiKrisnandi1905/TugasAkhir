@extends('Pelanggan.Layout.index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Keranjang Belanja</h2>
    @if($cart->count() > 0)
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    @foreach($cart as $item)
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
                                <div class="card-footer text-center">
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                    <button class="btn btn-primary btn-sm">Simpan untuk Nanti</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mt-4">
                    <a href="#" class="btn btn-success">Lanjutkan ke Pembayaran</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            Keranjang belanja kosong.
        </div>
    @endif
</div>

<style>
    .card {
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
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
    h5 {
        font-weight: bold;
        color: #333;
    }
    .card-text {
        font-size: 14px;
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
</style>
@endsection
