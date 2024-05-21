@extends('Admin.Layout.index')

@section('content')
<div class="card mb-3" id="Filter-Konveksi">
    <div class="card-body d-flex flex-row justify-content-between">
      <div class="filter d-flex flex-lg-row gap-3">
        <form action="{{ route('searchByDateKonveksi') }}" method="GET" class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center">
            <div class="d-flex gap-3">
                <input type="date" class="form-control" name="tgl">
                <button type="submit" class="btn btn-primary text-nowrap">Cari Tanggal</button>
            </div>
        </form>
      </div>
      <div class="search d-flex flex-lg-row gap-2">
        <form action="{{ route('searchKonveksi') }}" method="GET" class="d-flex gap-3 align-items-start align-items-lg-center">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>   
    </div>
</div>
<div class="card" id="Table-Konveksi">
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
        <button class="btn btn-danger fw-bold text-white ms-auto">Export</button>
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
          <th scope="col" class="col-4">Nama Layanan</th>
          <th scope="col" class="col-4">Kategori</th>
          <th scope="col" class="col-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($konveksis as $konveksi)
          <tr>
              <th scope="row">{{ $konveksi->id }}</th>
              <td>{{ $konveksi->tanggal_masuk }}</td>
              <td>{{ $konveksi->nama_produk }}</td>
              <td>{{ $konveksi->kategori->name }}</td>          
            <td>
              <div class="d-flex justify-content-center align-items-center gap-1">
                  <i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;" onclick="window.location.href = '{{ route('detailProdukKonveksi', ['id' => $konveksi->id]) }}';"></i>
                  <form id="deleteForm{{ $konveksi->id }}" action="{{ route('deleteProdukKonveksi', ['id' => $konveksi->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <i class="bi bi-trash-fill text-danger" style="font-size: 20px; cursor: pointer;" onclick="confirmDelete('{{ $konveksi->id }}')"></i>
                  </form>
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
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              {{ request()->input('rows', 10) }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#" data-value="10">10</a></li>
                <li><a class="dropdown-item" href="#" data-value="20">20</a></li>
                <li><a class="dropdown-item" href="#" data-value="30">30</a></li>
            </ul>
        </div>
        <span class="mr-2">Baris</span>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $konveksis->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @foreach ($konveksis->getUrlRange(1, $konveksis->lastPage()) as $page => $url)
                <li class="page-item {{ ($konveksis->currentPage() == $page) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item">
                <a class="page-link" href="{{ $konveksis->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
<script>
  function confirmDelete(konveksiId) {
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
              document.getElementById('deleteForm' + konveksiId).submit();
          }
      });
  }
</script>
<script>
  document.querySelectorAll('.dropdown-item').forEach(function(element) {
      element.addEventListener('click', function() {
          var value = this.getAttribute('data-value');
          window.location.href = "{{ route('konveksi') }}?rows=" + value;
      });
  });
</script>
@endsection
