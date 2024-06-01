@extends('Admin.Layout.index')

@section('content')
<div class="card" id="detailKonveksi">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div class="text-primary" onclick="window.location='{{ route('konveksi') }}';">
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
            <td id="idProduk">{{ $konveksis->id }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Tanggal Masuk</th>
            <td id="kategori">{{ $konveksis->tanggal_masuk }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Nama Produk</th>
            <td id="namaProduk">{{ $konveksis->nama_produk }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Kategori</th>
            <td id="kategori">{{ $konveksis->kategori->name }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Jenis Bahan</th>
            <td id="jenisBahan">{{ $konveksis->jenis }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-4">Upload Foto Contoh Produk Jadi</th>
            <td>Pakaian_Olahraga_Pria.jpg</td>
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
            <td id="deskripsi">{{ $konveksis->deskripsi }}</td>
          </tr>
        </tbody>
      </table>
      <h4>Detail warna dan ukuran bahan tersedia</h4>
      <table class="table table-bordered">
        <thead>
          <tr>
              <th scope="col">Warna</th>
              <th scope="col">Ukuran</th>
              <th scope="col">Harga</th>
              <th scope="col">Stock Bahan</th>
              <th scope="col">Gambar Contoh</th>
              <th scope="col">Terjual</th>
              <th scope="col">Aksi</th>
          </tr>
          </thead>
          <tbody>
          @foreach($variasiProdukKonveksi as $variasiProduk)
            <tr>
                <th scope="row">{{ $variasiProduk->warna_produk }}</th>
                <th class="ukuran">{{ $variasiProduk->ukuran }}</th>
                <td class="harga">{{ $variasiProduk->harga }}</td>
                <td class="stock">{{ $variasiProduk->stock }}</td>
                <td class="gambar">jersey.jpg</td>
                <td>15</td>
                <td><button class="btn btn-delete btn-danger btn-sm" style="display: none;" onclick="deleteRow(this)">Hapus</button></td>
            </tr>
          @endforeach
          </tbody>
      </table>
      <div class="mb-3 justify-content-center d-flex gap-4">
        <a href="{{ route('editProdukKonveksi', ['id' => $konveksis->id]) }}" class="btn btn-success w-75 fw-bold">Edit</a>
      </div>
    </div>    
</div>
@endsection