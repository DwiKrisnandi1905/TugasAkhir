@extends('Admin.Layout.index')

@section('content')
<div class="card" id="Transaksi">
    <div class="card-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th scope="row" class="col-4">Id Transaksi</th>
            <td>123</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Nama Lengkap</th>
            <td>Steve</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Alamat Lengkap</th>
            <td>Semarang</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">No Telepon</th>
            <td>081234567890</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Tanggal Transaksi</th>
            <td>24/02/2024</td>
          </tr> 
          <tr>
            <th scope="row" class="col-4">Metode Pembayaran</th>
            <td>Transfer BNI</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Status Pembayaran</th>
            <td>Belum Lunas</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Status Pengiriman</th>
            <td>Pending</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Estimasi Pengiriman</th>
            <td>27/02/2024</td>
          </tr> 
          <tr>
            <th scope="row" class="col-4">Estimasi Diterima</th>
            <td>01/03/2024</td>
          </tr> 
        </tbody>
      </table>
      <div class="mb-3 text-end justify-content-center d-flex">
        <button type="button" class="btn btn-primary w-75 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" class="col-3">Produk/Layanan</th>
            <th scope="col" class="col-2">Status Pengiriman</th>
            <th scope="col" class="col-2">Harga Satuan</th> 
            <th scope="col" class="col-1">Jumlah</th> 
            <th scope="col" class="col-2">Subtotal</th>  
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 20.000</td>
            <td>10</td>
            <td>Rp 200.000</td>
          </tr>
          <tr>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 20.000</td>
            <td>10</td>
            <td>Rp 200.000</td>
          </tr>
          <tr>
            <td colspan="4" class="text-center bg-secondary text-white">Total Pesanan</td>
            <td>Rp 400.000</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  {{-- popup edit --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keterangan Transaksi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="paymentStatus" class="form-label">Status Pembayaran</label>
            <select class="form-select" id="paymentStatus">
              <option value="lunas">Lunas</option>
              <option value="belum_lunas" selected>Belum Lunas</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="shippingStatus" class="form-label">Status Pengiriman</label>
            <select class="form-select" id="shippingStatus">
              <option value="pending" selected>Pending</option>
              <option value="diproses">Diproses</option>
              <option value="selesai">Selesai</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="shippingEstimate" class="form-label">Estimasi Pengiriman</label>
            <input type="date" class="form-control" id="shippingEstimate">
          </div>
          <div class="mb-3">
            <label for="deliveryEstimate" class="form-label">Estimasi Diterima</label>
            <input type="date" class="form-control" id="deliveryEstimate">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>
  {{-- popup edit end --}}
@endsection
