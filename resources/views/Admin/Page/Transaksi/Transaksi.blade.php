@extends('Admin.Layout.index')

@section('content')
<!-- Filters and Search -->
<div class="card mb-3" id="Filter-TokoBaju">
  <div class="card-body d-flex flex-row justify-content-between">
    <div class="filter d-flex flex-lg-row gap-3">
      <form action="{{ route('transaksi') }}" method="GET" class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center">
        <div class="d-flex gap-3">
          <input type="date" class="form-control" name="tgl" value="{{ request()->input('tgl') }}">
          <button type="submit" class="btn btn-primary text-nowrap">Cari Tanggal</button>
        </div>
      </form>
    </div>
    <div class="search d-flex flex-lg-row gap-2">
      <form action="{{ route('transaksi') }}" method="GET" class="d-flex gap-3 align-items-start align-items-lg-center">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="query" value="{{ request()->input('query') }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</div>

<!-- Pesanan Table -->
<div class="card" id="TransaksiPesanan">
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
        <div class="filter d-flex flex-lg-row gap-2">
          <button class="btn btn-info fw-bold text-white text-nowrap" onclick="window.location='{{ route('metodeTransaksi') }}';">
            <i class="fa fa-plus"></i>
            Metode Transaksi
          </button>
        </div>
      </div>
      <button class="btn btn-danger fw-bold text-white ms-auto" onclick="window.location='{{ route('exportPdf') }}';">Export PDF</button>
      <button class="btn btn-success fw-bold text-white ms-auto" onclick="window.location='{{ route('exportPesanan') }}';">Export Pesanan CSV</button>
      <button class="btn btn-success fw-bold text-white ms-auto" onclick="window.location='{{ route('exportPesananKonveksi') }}';">Export Pesanan Konveksi CSV</button>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col" class="col-2">Tgl. Transaksi</th>
          <th scope="col" class="col-2">Pelanggan</th>
          <th scope="col" class="col-3">Produk/Layanan</th>
          <th scope="col" class="col-1">Status Pengiriman</th>
          <th scope="col" class="col-2">Total</th>  
          <th scope="col" class="col-1">Jumlah</th>  
          <th scope="col" class="col-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data Pesanan -->
        @foreach($pesanan as $order)
        <tr>
          <th scope="row">{{ $order->id }}</th>
          <td>{{ $order->created_at->format('d/m/Y') }}</td>
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->nama_produk }}</td>
          <td>{{ $order->status }}</td>
          <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
          <td>{{ $order->kuantitas }}</td>
          <td>
            <div class="d-flex justify-content-center align-items-center gap-1">
              <i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;" onclick="window.location.href = '{{ route('detailTransaksi', ['type' => 'pesanan', 'id' => $order->id]) }}';"></i>
              <form id="deleteForm{{ $order->id }}" action="{{ route('deletePesanan', $order->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
              <i class="bi bi-trash-fill text-danger" style="font-size: 20px; cursor: pointer;" onclick="confirmDelete({{ $order->id }})"></i>
            </div>            
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-between mb-3">
      <div class="d-flex align-items-center mb-5"> 
        <span>Tampilkan</span>
        <div class="dropdown" style="padding: 0 8px;">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $rows_pesanan }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('transaksi', array_merge(request()->all(), ['rows_pesanan' => 10])) }}">10</a></li>
            <li><a class="dropdown-item" href="{{ route('transaksi', array_merge(request()->all(), ['rows_pesanan' => 20])) }}">20</a></li>
            <li><a class="dropdown-item" href="{{ route('transaksi', array_merge(request()->all(), ['rows_pesanan' => 50])) }}">50</a></li>
          </ul>
        </div>
        <span class="mr-2">Baris</span>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $pesanan->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $pesanan->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @foreach ($pesanan->getUrlRange(1, $pesanan->lastPage()) as $page => $url)
                <li class="page-item {{ ($pesanan->currentPage() == $page) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $pesanan->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $pesanan->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Pesanan Konveksi Table -->
<div class="card mt-5" id="TransaksiPesananKonveksi">
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col" class="col-2">Tgl. Transaksi</th>
          <th scope="col" class="col-2">Pelanggan</th>
          <th scope="col" class="col-3">Produk/Layanan</th>
          <th scope="col" class="col-1">Status Pengiriman</th>
          <th scope="col" class="col-2">Total</th>  
          <th scope="col" class="col-1">Jumlah</th>  
          <th scope="col" class="col-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data Pesanan Konveksi -->
        @foreach($pesananKonveksi as $order)
        <tr>
          <th scope="row">{{ $order->id }}</th>
          <td>{{ $order->created_at->format('d/m/Y') }}</td>
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->nama_produk }}</td>
          <td>{{ $order->status }}</td>
          <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
          <td>{{ $order->kuantitas }}</td>
          <td>
            <div class="d-flex justify-content-center align-items-center gap-1">
              <i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;" onclick="window.location.href = '{{ route('detailTransaksi', ['type' => 'pesananKonveksi', 'id' => $order->id]) }}';"></i>
              <form id="deleteForm{{ $order->id }}" action="{{ route('deletePesananKonveksi', $order->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
              <i class="bi bi-trash-fill text-danger" style="font-size: 20px; cursor: pointer;" onclick="confirmDelete({{ $order->id }})"></i>
            </div>            
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-between mb-3">
      <div class="d-flex align-items-center mb-5"> 
        <span>Tampilkan</span>
        <div class="dropdown" style="padding: 0 8px;">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $rows_pesanan_konveksi }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('transaksi', array_merge(request()->all(), ['rows_pesanan_konveksi' => 10])) }}">10</a></li>
            <li><a class="dropdown-item" href="{{ route('transaksi', array_merge(request()->all(), ['rows_pesanan_konveksi' => 20])) }}">20</a></li>
            <li><a class="dropdown-item" href="{{ route('transaksi', array_merge(request()->all(), ['rows_pesanan_konveksi' => 50])) }}">50</a></li>
          </ul>
        </div>
        <span class="mr-2">Baris</span>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $pesananKonveksi->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $pesananKonveksi->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @foreach ($pesananKonveksi->getUrlRange(1, $pesananKonveksi->lastPage()) as $page => $url)
                <li class="page-item {{ ($pesananKonveksi->currentPage() == $page) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $pesananKonveksi->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $pesananKonveksi->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
<script>
  function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
      document.getElementById('deleteForm' + id).submit();
    }
  }
</script>
@endsection
