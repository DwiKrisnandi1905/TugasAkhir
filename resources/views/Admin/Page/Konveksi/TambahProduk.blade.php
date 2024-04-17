@extends('Admin.Layout.index')

@section('content')
<div class="card mb-3" id="Filter-TokoBaju">
    <div class="card-body">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk">
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori:</label>
            <select class="form-select" id="kategoriKonveksi">
                <option value="pending" selected>Jersey Futsal</option>
                <option value="diproses">Jersey Badminton</option>
                <option value="selesai">Jersey Sepak Bola</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Bahan:</label>
            <input type="text" class="form-control" id="jenis" name="jenis">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarnaBahan">Tambahkan Warna Bahan</button>
        </div>
        <div class="mb-3">
            <label for="ukuran" class="form-label">Pilih Ukuran:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_xxxl" value="xxxl">
                <label class="form-check-label" for="ukuran_xxxl">XXXL</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_xxl" value="xxl">
                <label class="form-check-label" for="ukuran_xxl">XXL</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_XL" value="XL">
                <label class="form-check-label" for="ukuran_XL">XL</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_L" value="L">
                <label class="form-check-label" for="ukuran_L">L</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ukuran" id="ukuran_M" value="M">
                <label class="form-check-label" for="ukuran_M">M</label>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <button type="button" class="btn btn-success">Simpan</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalWarnaBahan" tabindex="-1" aria-labelledby="modalWarnaBahanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalWarnaBahanLabel">Tambahkan Warna Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="warna_bahan" class="form-label">Warna Bahan:</label>
                    <input type="text" class="form-control" id="warna_bahan" name="warna_bahan">
                </div>
                <div class="mb-3">
                    <label for="stock_bahan" class="form-label">Stock Bahan:</label>
                    <input type="text" class="form-control" id="stock_bahan" name="stock_bahan">
                </div>
                <div class="mb-3">
                    <label for="foto_bahan" class="form-label">Upload Foto Bahan:</label>
                    <input type="file" class="form-control" id="foto_bahan" name="foto_bahan" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
