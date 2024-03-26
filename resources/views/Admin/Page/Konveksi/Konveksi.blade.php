@extends('Admin.Layout.index')

@section('content')
<div class="card mb-3" id="Filter-TokoBaju">
    <div class="card-body d-flex flex-row justify-content-between">
        <div class="filter d-flex flex-lg-row gap-3">
            <input type="date" class="form-control" name="tgl">
            <button class="btn btn-primary text-nowrap">Cari Tanggal</button>
        </div>
        <div class="search d-flex flex-lg-row gap-2">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </div>
</div>
<div class="card" id="Table-TokoBaju">
  <div class="card-body">
    <div class="d-flex justify-content-start mb-3 gap-2">
        <button class="btn btn-info fw-bold text-white" onclick="window.location='{{ route('produkKonveksi') }}';">
            <i class="fa fa-plus"></i>
            Tambak Produk
        </button>
        <button class="btn btn-success fw-bold text-white" onclick="window.location='{{ route('kategoriKonveksi') }}';">
            <i class="fa fa-plus"></i>
            Tambak Kategori
        </button>
    </div>
    {{-- <div class="d-flex justify-content-between mb-3">
      <div class="d-flex align-items-center"> 
        <div class="dropdown" style="padding: 0 8px;">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">A - Z</a></li>
          </ul>
        </div>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div> --}}
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col" class="col-2">Tanggal Masuk</th>
          <th scope="col" class="col-3">Nama Layanan</th>
          <th scope="col" class="col-3">Kategori</th>
          <th scope="col" class="col-2">Harga</th>
          <th scope="col" class="col-2">Stock bahan</th>
          <th scope="col" class="col-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
          <td>
            <button class="btn btn-primary">Detail</button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>23/03/2024</td>
          <td>Jersey Futsal</td>
          <td>Pakaian olahraga pria</td>
          <td>Rp 80.000,00</td>
          <td>30</td>
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
