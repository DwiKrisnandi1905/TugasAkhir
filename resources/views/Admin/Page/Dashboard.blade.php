@extends('Admin.Layout.index')

@section('content')
<style>
  .card-custom {
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
    background-color: #ffbb33; /* Orange theme */
    color: #fff;
  }
  .card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }
  .icon-custom {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    border-radius: 10px;
    background-color: #fff;
    color: #ffbb33; /* Orange theme */
  }
  .text-muted-custom {
    font-size: 14px;
    color: #fff;
  }
  .font-weight-bold-custom {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
  }
  .d-flex-custom {
    display: flex;
    align-items: center;
  }
</style>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card card-custom shadow-sm">
        <div class="card-body d-flex-custom">
          <div class="icon icon-lg icon-custom shadow">
            <i class="bi bi-eye-fill"></i>
          </div>
          <div>
            <p class="text-muted text-muted-custom mb-1">Total Transaksi</p>
            <h4 class="font-weight-bold font-weight-bold-custom">Rp {{ number_format($totalTransaksi) }} </h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card card-custom shadow-sm">
        <div class="card-body d-flex-custom">
          <div class="icon icon-lg icon-custom shadow">
            <i class="bi bi-people-fill"></i>
          </div>
          <div>
            <p class="text-muted text-muted-custom mb-1">Total Pengguna</p>
            <h4 class="font-weight-bold font-weight-bold-custom">{{ $totalUsers }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card card-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#totalItemsModal" style="cursor: pointer;">
        <div class="card-body d-flex-custom">
          <div class="icon icon-lg icon-custom shadow">
            <i class="bi bi-box-seam"></i>
          </div>
          <div>
            <p class="text-muted text-muted-custom mb-1">Total Produk & Konveksi</p>
            <h4 class="font-weight-bold font-weight-bold-custom">{{ $totalItems }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card card-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#totalProdukTerjual" style="cursor: pointer;">
        <div class="card-body d-flex-custom">
          <div class="icon icon-lg icon-custom shadow">
            <i class="bi bi-cart-fill"></i>
          </div>
          <div>
            <p class="text-muted text-muted-custom mb-1">Produk Terjual</p>
            <h4 class="font-weight-bold font-weight-bold-custom">{{ $totalTerjual }}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="totalItemsModal" tabindex="-1" aria-labelledby="totalItemsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="totalItemsModalLabel">Detail Total Produk & Konveksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Total Produk:</strong> {{ $totalProduk }}</p>
        <p><strong>Total Konveksi:</strong> {{ $totalKonveksi }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="totalProdukTerjual" tabindex="-1" aria-labelledby="totalProdukTerjualLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="totalProdukTerjualLabel">Detail Total Produk & Konveksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Total Produk Terjual:</strong> {{ $TotalPesananTerjual }}</p>
        <p><strong>Total Konveksi Terjual:</strong> {{ $TotalPesananKonveksiTerjual }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
