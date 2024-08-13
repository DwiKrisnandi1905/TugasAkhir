@extends('admin.layout.index')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="mb-3 text-primary" onclick="window.location='{{ route('kategoriTokobaju') }}';">
            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
        </div>
        <form action="{{ route('updateKategori', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kategoriTokobaju" class="form-label">Edit Kategori:</label>
                <input type="text" class="form-control" id="kategoriTokobaju" name="kategoriTokobaju" value="{{ $kategori->name }}" placeholder="Contoh: Pakaian Pria" required>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
