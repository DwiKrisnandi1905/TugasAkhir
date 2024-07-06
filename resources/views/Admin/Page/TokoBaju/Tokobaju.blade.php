@extends('Admin.Layout.index')

@section('content')
<div class="card mb-3" id="Filter-TokoBaju">
    <div class="card-body d-flex flex-row justify-content-between">
      <div class="filter d-flex flex-lg-row gap-3">
        <form action="{{ route('searchByDate') }}" method="GET" class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center">
            <div class="d-flex gap-3">
                <input type="date" class="form-control" name="tgl">
                <button type="submit" class="btn btn-primary text-nowrap">Cari Tanggal</button>
            </div>
        </form>
      </div>
      <div class="search d-flex flex-lg-row gap-2">
        <form action="{{ route('search') }}" method="GET" class="d-flex gap-3 align-items-start align-items-lg-center">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>    
    </div>
</div>
<div class="card" id="Table-TokoBaju">
  <div class="card-body">
    <div class="d-flex justify-content-start mb-3 gap-2">
        <button class="btn btn-info fw-bold text-white" onclick="window.location='{{ route('produkTokobaju') }}';">
            <i class="fa fa-plus"></i>
            Tambah Produk
        </button>
        <button class="btn btn-success fw-bold text-white" onclick="window.location='{{ route('kategoriTokobaju') }}';">
            <i class="fa fa-plus"></i>
            Tambah Kategori
        </button>
        {{-- <button class="btn btn-danger fw-bold text-white ms-auto">Export</button> --}}
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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col" class="col-4">Tanggal Masuk</th>
          <th scope="col" class="col-4">Nama Produk</th>
          <th scope="col" class="col-4">Kategori</th>
          <th scope="col" class="col-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($produks as $produk)
        <tr>
            <th scope="row">{{ $produk->id }}</th>
            <td>{{ $produk->tanggal_masuk }}</td>
            <td>{{ $produk->nama_produk }}</td>
            <td>{{ $produk->kategori->name }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center gap-1">
                  <i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;" onclick="window.location.href = '{{ route('detailProdukTokobaju', ['id' => $produk->id]) }}';"></i>
                  <form id="deleteForm{{ $produk->id }}" action="{{ route('deleteProduk', ['id' => $produk->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <i class="bi bi-trash-fill text-danger" style="font-size: 20px; cursor: pointer;" onclick="confirmDelete('{{ $produk->id }}')"></i>
                  </form>
                </div>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-between mb-3">
      <form class="d-flex align-items-center" action="{{ route('tokobaju') }}" method="GET"> 
        <span>Tampilkan</span>
        <div class="dropdown" style="padding: 0 8px;">
          <select name="rows" class="form-select" onchange="this.form.submit()">
            <option value="10" {{ request()->input('rows') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request()->input('rows') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request()->input('rows') == 50 ? 'selected' : '' }}>50</option>
          </select>
        </div>
        <span class="mr-2">Baris</span>
        <input type="hidden" name="search" value="{{ request()->input('search') }}">
      </form>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $produks->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $produks->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                <li class="page-item {{ ($produks->currentPage() == $page) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $produks->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $produks->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
<script>
    function confirmDelete(produkId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan terhapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + produkId).submit();
            }
        });
    }
</script>
<script>
  document.querySelectorAll('.dropdown-item').forEach(function(element) {
      element.addEventListener('click', function() {
          var value = this.getAttribute('data-value');
          window.location.href = "{{ route('tokobaju') }}?rows=" + value;
      });
  });
</script>
@endsection
