@extends('Pelanggan.Layout.index')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4 text-center">Masukkan Alamat Pengiriman</h2>
    <form action="{{ route('alamat.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_pemilik_rumah">Nama Pemilik Rumah</label>
            <input type="text" class="form-control" id="nama_pemilik_rumah" name="nama_pemilik_rumah" required>
        </div>
        <div class="form-group">
            <label for="alamat_lengkap">Alamat Lengkap</label>
            <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" required></textarea>
        </div>
        <div class="form-group">
            <label for="kode_pos">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
        </div>
        <div class="form-group">
            <label for="link_lokasi">Link Lokasi (Google Map)</label>
            <input type="text" class="form-control" id="link_lokasi" name="link_lokasi" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Alamat</button>
    </form>
</div>

@endsection
