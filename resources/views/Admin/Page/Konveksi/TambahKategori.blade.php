@extends('admin.layout.index')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="mb-3 text-primary" onclick="window.location='{{ route('konveksi') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('storeeKategori') }}" method="POST">
          @csrf
          <div class="mb-3">
              <label for="kategoriKonveksi" class="form-label">Tambah Kategori:</label>
              <input type="text" class="form-control" id="kategoriKonveksi" name="kategoriKonveksi" placeholder="Contoh: Pakaian Olahraga">
          </div>
          <div class="d-flex justify-content-center mb-3">
              <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
        <h4 class="fw-bold">Daftar Kategori</h4>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="col-1">No</th>
                <th scope="col" class="col-12">Kategori</th>
                <th scope="col" class="col-12">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kategoriKonveksi as $index => $kategori)
                <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>{{ $kategori->name }}</td>
                  <td>
                    <div class="d-flex justify-content-center align-items-center">
                      <a href="{{ route('editKategoriKonveksi', $kategori->id) }}" class="text-warning me-2">
                        <i class="bi bi-pencil-square" style="font-size: 20px; cursor: pointer;"></i>
                      </a>
                      <form action="{{ route('deleteeKategori', $kategori->id) }}" method="POST" id="deleteForm{{ $kategori->id }}">
                        @csrf
                        @method('DELETE')
                        <i class="bi bi-trash-fill text-danger" style="font-size: 20px; cursor: pointer;" onclick="confirmDelete('{{ $kategori->id }}')"></i>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/kategoriKonveksi.js') }}"></script>
@endsection