@extends('Admin.Layout.index')

@section('content')
<div class="card" id="Pelanggan">
  <div class="card-body">
    <!-- Filter and Export buttons -->
    <div class="d-flex justify-content-between mb-3">
      <!-- Filter dropdown and Export button -->
      <div class="d-flex align-items-center"> 
        {{-- <div class="dropdown" style="padding: 0 8px;">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">A - Z</a></li>
          </ul>
        </div>
        <button class="btn btn-danger fw-bold text-white">Export</button> --}}
      </div>
      <!-- Search form -->
      <form class="d-flex" role="search" action="{{ route('pelanggan') }}" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" value="{{ request()->input('search') }}" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    
    <!-- Table of users -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" class="col-1">Id</th>
          <th scope="col" class="col-4">Nama</th>
          <th scope="col" class="col-4">Email</th>
          <th scope="col" class="col-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <div class="d-flex justify-content-center align-items-center gap-1">
              <a href="{{ route('detailUser', ['id' => $user->id]) }}"><i class="bi bi-info-circle-fill text-primary" style="font-size: 20px; cursor: pointer;"></i></a>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">Tidak ada data yang cocok</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    
    <!-- Pagination and "Rows per Page" dropdown -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <!-- Rows per Page dropdown -->
      <form class="d-flex align-items-center" action="{{ route('pelanggan') }}" method="GET"> 
        <span>Tampilkan</span>
        <div class="dropdown" style="padding: 0 8px;">
          <select name="rowsPerPage" class="form-select" onchange="this.form.submit()">
            <option value="10" {{ request()->input('rowsPerPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request()->input('rowsPerPage') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request()->input('rowsPerPage') == 50 ? 'selected' : '' }}>50</option>
          </select>
        </div>
        <span class="mr-2">Baris</span>
        <input type="hidden" name="search" value="{{ request()->input('search') }}">
      </form>
      
      <!-- Pagination links -->
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            <li class="page-item {{ ($users->currentPage() == $page) ? 'active' : '' }}">
              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
          @endforeach
          <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
@endsection
