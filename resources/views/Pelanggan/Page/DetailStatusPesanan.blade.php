@extends('Pelanggan.Layout.index')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .card {
        border: none;
        border-radius: .5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 1.5rem; /* Meningkatkan spasi antar kartu */
        padding: 1.5rem;
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-body {
        padding: 1.5rem;
        border: 2px solid #ff7f50;
        border-radius: .5rem;
    }
    .card-title {
        font-size: 1.8rem; /* Meningkatkan ukuran judul */
        margin-bottom: 1rem;
        color: #333;
    }
    .card-text {
        font-size: 1.1rem; /* Meningkatkan ukuran teks */
        color: #6c757d;
        margin-bottom: 0.7rem; /* Spasi antar paragraf */
    }
    .link, .modal-link {
        cursor: pointer;
        color: #007bff;
        text-decoration: none;
    }
    .modal-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="mb-3 text-primary text-start" onclick="window.location='{{ route('statusPesanan') }}';">
                <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title text-start">{{ $pesanan->nama_produk }}</h3>
                    <p class="card-text text-start"><strong>ID:</strong> <span class="text-end">{{ $pesanan->id }}</span></p>
                    <p class="card-text text-start"><strong>Foto Produk:</strong> 
                        @if($pesanan->image)
                        <a href="#" class="modal-link" data-bs-toggle="modal" data-bs-target="#productImageModal">Lihat Gambar</a>
                        @else
                        Tidak Ada Gambar
                        @endif
                    </p>
                    <p class="card-text text-start"><strong>Nama Produk:</strong> <span class="text-end">{{ $pesanan->nama_produk }}</span></p>
                    <p class="card-text text-start"><strong>Warna:</strong> <span class="text-end">{{ $pesanan->warna }}</span></p>
                    <p class="card-text text-start"><strong>Ukuran:</strong> <span class="text-end">{{ $pesanan->ukuran }}</span></p>
                    <p class="card-text text-start"><strong>Kuantitas:</strong> <span class="text-end">{{ $pesanan->kuantitas }}</span></p>
                    <p class="card-text text-start"><strong>Harga Satuan:</strong> <span class="text-end">{{ $pesanan->harga_satuan }}</span></p>
                    <p class="card-text text-start"><strong>Total Harga:</strong> <span class="text-end">{{ $pesanan->total_harga }}</span></p>
                    <p class="card-text text-start"><strong>Nama Pemilik Rumah:</strong> <span class="text-end">{{ $pesanan->nama_pemilik_rumah }}</span></p>
                    <p class="card-text text-start"><strong>Alamat Lengkap:</strong> <span class="text-end">{{ $pesanan->alamat_lengkap }}</span></p>
                    <p class="card-text text-start"><strong>Kode Pos:</strong> <span class="text-end">{{ $pesanan->kode_pos }}</span></p>
                    <p class="card-text text-start"><strong>Link Lokasi:</strong>
                        @if($pesanan->link_lokasi)
                        <a href="{{ $pesanan->link_lokasi }}" class="link" target="_blank">Lihat Lokasi</a>
                        @else
                            -
                        @endif
                    </p>
                    <p class="card-text text-start"><strong>Metode Pembayaran:</strong> <span class="text-end">{{ $pesanan->metode_pembayaran }}</span></p>
                    <p class="card-text text-start"><strong>No Rekening:</strong> <span class="text-end">{{ $pesanan->no_rekening ? $pesanan->no_rekening : '-' }}</span></p>
                    <p class="card-text text-start"><strong>Bukti Pembayaran:</strong>
                        @if($pesanan->bukti_pembayaran)
                            <span class="modal-link" data-bs-toggle="modal" data-bs-target="#buktiPembayaranModal">Lihat Bukti Pembayaran</span>
                        @else
                            -
                        @endif
                    </p>
                    <p class="card-text text-start"><strong>Status:</strong> <span class="text-end">{{ $pesanan->status }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Product Image -->
<div class="modal fade" id="productImageModal" tabindex="-1" aria-labelledby="productImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productImageModalLabel">Product Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('images/' . $pesanan->image) }}" alt="Product Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<!-- Modal for Bukti Pembayaran -->
<div class="modal fade" id="buktiPembayaranModal" tabindex="-1" aria-labelledby="buktiPembayaranModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiPembayaranModalLabel">Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
