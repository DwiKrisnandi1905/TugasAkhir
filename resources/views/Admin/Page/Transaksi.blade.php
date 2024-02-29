@extends('Admin.Layout.index')

@section('content')
<div class="card" id="Pelanggan">
    <div class="card-body">
      <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center"> 
          <div class="dropdown" style="padding: 0 8px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Filters
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">A - Z</a></li>
              <li><a class="dropdown-item" href="#">Harga Tertinggi - Harga Terendah</a></li>
              <li><a class="dropdown-item" href="#">Status</a></li>
            </ul>
          </div>
        </div>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col" class="col-2">Tgl. Transaksi</th>
            <th scope="col" class="col-1">Pembayaran</th>
            <th scope="col" class="col-2">Pelanggan</th>
            <th scope="col" class="col-3">Produk</th>
            <th scope="col" class="col-2.5">Status</th>
            <th scope="col" class="col-3">Total</th>
            <th scope="col" class="col-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">6</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">7</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">8</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">9</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
          <tr>
            <th scope="row">10</th>
            <td>24 Febuari 2024</td>
            <td>Belum Lunas</td>
            <td>John Krammer</td>
            <td>konveksi jersey futsal</td>
            <td>diproses</td>
            <td>Rp 200.000</td>
            <td>
              <button class="btn btn-primary">Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center mb-5"> 
          <span>Tampilkan</span>
          <div class="dropdown" style="padding: 0 8px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              10
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">10</a></li>
              <li><a class="dropdown-item" href="#">20</a></li>
              <li><a class="dropdown-item" href="#">50</a></li>
            </ul>
          </div>
          <span class="mr-2">Baris</span>
        </div>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
@endsection
