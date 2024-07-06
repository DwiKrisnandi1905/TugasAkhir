@extends('Admin.Layout.index')

@section('content')
<div class="card" id="History">
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
                <form action="{{ route('history') }}" method="GET" class="filter d-flex flex-lg-row gap-2 align-items-start align-items-lg-center">
                    <input type="date" class="form-control" name="tgl" value="{{ request()->input('tgl') }}">
                    <button type="submit" class="btn btn-primary text-nowrap">Cari Tanggal</button>
                </form>
                <div class="dropdown ms-2">
                    <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      Export
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                      <li><a class="dropdown-item" href="{{ route('exportHistory', request()->all()) }}">History PDF</a></li>
                      <li><a class="dropdown-item" href="{{ route('exportHistoryPesanan', request()->all()) }}">History Pesanan CSV</a></li>
                      <li><a class="dropdown-item" href="{{ route('exportHistoryPesananKonveksi', request()->all()) }}">History Pesanan Konveksi CSV</a></li>
                    </ul>
                </div>
            </div>
            <form action="{{ route('history') }}" method="GET" class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query" value="{{ request()->input('query') }}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        
        <!-- Tabel untuk Pesanan -->
        <h4>Pesanan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col" class="col-2">Tgl. Transaksi</th>
                    <th scope="col" class="col-2">Pelanggan</th>
                    <th scope="col" class="col-3">Produk</th>
                    <th scope="col" class="col-3">Status</th>
                    <th scope="col" class="col-3">Total</th>
                    <th scope="col" class="col-2">Jumlah</th>
                    <th scope="col" class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesananSelesaiDibatalkan as $pesanan)
                    <tr>
                        <th scope="row">{{ $pesanan->id }}</th>
                        <td>{{ $pesanan->created_at->format('d/m/Y') }}</td>
                        <td>{{ $pesanan->user->name }}</td>
                        <td>{{ $pesanan->nama_produk }}</td>
                        <td>{{ ucfirst($pesanan->status) }}</td>
                        <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $pesanan->kuantitas }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;" onclick="window.location.href = '{{ route('detailHistory', ['type' => 'pesanan', 'id' => $pesanan->id]) }}';"></i>
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
                        {{ request()->input('pesanan_rows', 10) }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('history', array_merge(request()->all(), ['pesanan_rows' => 10, 'pesanan_page' => $pesananSelesaiDibatalkan->currentPage()])) }}">10</a></li>
                        <li><a class="dropdown-item" href="{{ route('history', array_merge(request()->all(), ['pesanan_rows' => 20, 'pesanan_page' => $pesananSelesaiDibatalkan->currentPage()])) }}">20</a></li>
                        <li><a class="dropdown-item" href="{{ route('history', array_merge(request()->all(), ['pesanan_rows' => 50, 'pesanan_page' => $pesananSelesaiDibatalkan->currentPage()])) }}">50</a></li>
                    </ul>
                </div>
                <span class="mr-2">Baris</span>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Paginasi -->
                    <li class="page-item {{ $pesananSelesaiDibatalkan->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ route('history', array_merge(request()->all(), ['pesanan_page' => $pesananSelesaiDibatalkan->currentPage() - 1])) }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @foreach ($pesananSelesaiDibatalkan->getUrlRange(1, $pesananSelesaiDibatalkan->lastPage()) as $page => $url)
                        <li class="page-item {{ $pesananSelesaiDibatalkan->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('history', array_merge(request()->all(), ['pesanan_page' => $page])) }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $pesananSelesaiDibatalkan->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ route('history', array_merge(request()->all(), ['pesanan_page' => $pesananSelesaiDibatalkan->currentPage() + 1])) }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Tabel untuk Pesanan Konveksi -->
        <h4>Pesanan Konveksi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col" class="col-2">Tgl. Transaksi</th>
                    <th scope="col" class="col-2">Pelanggan</th>
                    <th scope="col" class="col-3">Produk</th>
                    <th scope="col" class="col-3">Status</th>
                    <th scope="col" class="col-3">Total</th>
                    <th scope="col" class="col-2">Jumlah</th>
                    <th scope="col" class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesananKonveksiSelesaiDibatalkan as $pesananKonveksi)
                    <tr>
                        <th scope="row">{{ $pesananKonveksi->id }}</th>
                        <td>{{ $pesananKonveksi->created_at->format('d/m/Y') }}</td>
                        <td>{{ $pesananKonveksi->user->name }}</td>
                        <td>{{ $pesananKonveksi->nama_produk }}</td>
                        <td>{{ ucfirst($pesananKonveksi->status) }}</td>
                        <td>Rp {{ number_format($pesananKonveksi->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $pesananKonveksi->kuantitas }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;" onclick="window.location.href = '{{ route('detailHistory', ['type' => 'pesananKonveksi', 'id' => $pesananKonveksi->id]) }}';"></i>
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
                        {{ request()->input('pesanan_konveksi_rows', 10) }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('history', array_merge(request()->all(), ['pesanan_konveksi_rows' => 10, 'pesanan_konveksi_page' => $pesananKonveksiSelesaiDibatalkan->currentPage()])) }}">10</a></li>
                        <li><a class="dropdown-item" href="{{ route('history', array_merge(request()->all(), ['pesanan_konveksi_rows' => 20, 'pesanan_konveksi_page' => $pesananKonveksiSelesaiDibatalkan->currentPage()])) }}">20</a></li>
                        <li><a class="dropdown-item" href="{{ route('history', array_merge(request()->all(), ['pesanan_konveksi_rows' => 50, 'pesanan_konveksi_page' => $pesananKonveksiSelesaiDibatalkan->currentPage()])) }}">50</a></li>
                    </ul>
                </div>
                <span class="mr-2">Baris</span>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Paginasi -->
                    <li class="page-item {{ $pesananKonveksiSelesaiDibatalkan->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ route('history', array_merge(request()->all(), ['pesanan_konveksi_page' => $pesananKonveksiSelesaiDibatalkan->currentPage() - 1])) }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @foreach ($pesananKonveksiSelesaiDibatalkan->getUrlRange(1, $pesananKonveksiSelesaiDibatalkan->lastPage()) as $page => $url)
                        <li class="page-item {{ $pesananKonveksiSelesaiDibatalkan->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('history', array_merge(request()->all(), ['pesanan_konveksi_page' => $page])) }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $pesananKonveksiSelesaiDibatalkan->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ route('history', array_merge(request()->all(), ['pesanan_konveksi_page' => $pesananKonveksiSelesaiDibatalkan->currentPage() + 1])) }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
