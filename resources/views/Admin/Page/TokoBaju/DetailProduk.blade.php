@extends('Admin.Layout.index')

@section('content')
<div class="card" id="detailTokobaju">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="text-primary" onclick="window.location='{{ route('tokobaju') }}';">
                <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th scope="row" class="col-4">Id Produk</th>
            <td id="idProduk">{{ $produks->id }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Tanggal Masuk</th>
            <td id="kategori">{{ $produks->tanggal_masuk }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Nama Produk</th>
            <td id="namaProduk">{{ $produks->nama_produk }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Kategori</th>
            <td id="kategori">{{ $produks->kategori->name }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Foto Produk Untuk Tampilan Utama</th>
            <td id="fotoProduk">
                <a href="#" data-bs-toggle="modal" data-bs-target="#mainImageModal" style="text-decoration: none; color: #FFF; background-color: #000; padding-left: 10px; padding-right: 10px; border-radius: 8px;">{{ $produks->foto_produk }}</a>
            </td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Total Terjual</th>
            <td>75</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Penilaian Suka</th>
            <td>72</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Penilaian Tidak Suka</th>
            <td>3</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Penilaian Rating</th>
            <td>4.9</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Deskripsi</th>
            <td id="deskripsi">{{ $produks->deskripsi_produk }}</td>
          </tr>
        </tbody>
      </table>
      <h4>Detail warna dan ukuran produk</h4>
        <table class="table table-bordered">         
            <thead>
            <tr>
                <th scope="col">Warna</th>
                <th scope="col">Ukuran</th>
                <th scope="col">Harga</th>
                <th scope="col">Stock</th>
                <th scope="col">Gambar</th>
                <th scope="col">Terjual</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($variasiProduk as $variasi)
              <tr>
                  <th scope="row">{{ $variasi->warna_produk }}</th>
                  <th class="ukuran">{{ $variasi->ukuran }}</th>
                  <td class="harga">{{ $variasi->harga }}</td>
                  <td class="stock">{{ $variasi->stock }}</td>
                  <td class="gambar">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#modalImageModal_{{ $variasi->id }}" style="text-decoration: none; color: #FFF; background-color: #000; padding-left: 10px; padding-right: 10px; border-radius: 8px;">{{ $variasi->foto_produk_modal }}</a>
                  </td>
                  <td>15</td>
                  <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
              </tr>

              <!-- Modal for Variasi Images -->
              <div class="modal fade" id="modalImageModal_{{ $variasi->id }}" tabindex="-1" aria-labelledby="modalImageModalLabel_{{ $variasi->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="modalImageModalLabel_{{ $variasi->id }}">Foto Produk</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                              <img src="{{ asset('images/' . $variasi->foto_produk_modal) }}" alt="Foto Produk Modal" class="img-fluid">
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach
            </tbody>
        </table>
        <div class="mb-3 justify-content-center d-flex gap-4">
          <a href="{{ route('editProduk', ['id' => $produks->id]) }}" class="btn btn-success w-75 fw-bold">Edit</a>
      </div>      
    </div>    
</div>

<!-- Modal for Main Image -->
<div class="modal fade" id="mainImageModal" tabindex="-1" aria-labelledby="mainImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mainImageModalLabel">Foto Produk Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('images/' . $produks->foto_produk) }}" alt="Foto Produk" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection
