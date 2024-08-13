@extends('admin.layout.index')

@section('content')
<div class="card" id="editProduk">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="text-primary" onclick="window.location='{{ route('detailProdukKonveksi', ['id' => $konveksis->id]) }}';">
                <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
            </div>
        </div>
        <form method="POST" action="{{ route('updateProdukKonveksi', ['id' => $konveksis->id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="namaProduk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="namaProduk" name="nama_produk" value="{{ $konveksis->nama_produk }}">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori_id">
                    @foreach($kategoriKonveksi as $kategori)
                        <option value="{{ $kategori->id }}" {{ $konveksis->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $konveksis->deskripsi }}</textarea>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Warna Produk</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konveksis->variasi as $variasi)
                        <tr>
                            <td><input type="text" class="form-control" name="warna_produk[]" value="{{ $variasi->warna_produk }}"></td>
                            <td><input type="text" class="form-control" name="ukuran[]" value="{{ $variasi->ukuran }}"></td>
                            <td><input type="text" class="form-control" name="harga[]" value="{{ $variasi->harga }}"></td>
                            <td><input type="text" class="form-control" name="stock[]" value="{{ $variasi->stock }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>    
</div>
@endsection
