@extends('admin.layout.index')

@section('content')
<style>
    .table-responsive {
        overflow-x: auto;
    }
    .vertical-table th {
        width: 30%; /* Sesuaikan lebar kolom label */
    }
</style>
<div class="container">
    <div class="mb-3 text-primary" onclick="window.location='{{ route('history') }}';">
        <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
    </div>
    <div class="modal fade" id="modalGambar" tabindex="-1" aria-labelledby="modalGambarLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGambarLabel">Gambar Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="gambarModal" src="" class="img-fluid" alt="Gambar Produk">
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <h2>Detail Pesanan</h2>
        <table class="table table-bordered vertical-table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $order->id }}</td>
                </tr>
                @if($type === 'pesanan')
                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $order->nama_produk }}</td>
                </tr>
                <tr>
                    <th>Warna</th>
                    <td>{{ $order->warna }}</td>
                </tr>
                <tr>
                    <th>Ukuran</th>
                    <td>{{ $order->ukuran }}</td>
                </tr>
                <tr>
                    <th>Kuantitas</th>
                    <td>{{ $order->kuantitas }}</td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td>{{ $order->harga_satuan }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>{{ $order->total_harga }}</td>
                </tr>
                @else
                <tr>
                    <th>Nama Produk Konveksi</th>
                    <td>{{ $order->nama_produk }}</td>
                </tr>
                <tr>
                    <th>Warna Bahan</th>
                    <td>{{ $order->warna }}</td>
                </tr>
                <tr>
                    <th>Ukuran Bahan</th>
                    <td>{{ $order->ukuran }}</td>
                </tr>
                <tr>
                    <th>Kuantitas Bahan</th>
                    <td>{{ $order->kuantitas }}</td>
                </tr>
                <tr>
                    <th>Harga Bahan Satuan</th>
                    <td>{{ $order->harga_satuan }}</td>
                </tr>
                <tr>
                    <th>Total Harga Bahan</th>
                    <td>{{ $order->total_harga }}</td>
                </tr>
                @endif
                <tr>
                    <th>Status</th>
                    <td>{{ $order->status }}</td>
                </tr>
                <tr>
                    <th>Konfirmasi Nama Pembeli</th>
                    <td>{{ $order->nama_pemilik_rumah }}</td>
                </tr>
                <tr>
                    <th>Alamat Lengkap</th>
                    <td>{{ $order->alamat_lengkap }}</td>
                </tr>
                <tr>
                    <th>Kode Pos</th>
                    <td>{{ $order->kode_pos }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><a href="{{ $order->link_lokasi }}" target="_blank">Lihat Lokasi</a></td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $order->metode_pembayaran }}</td>
                </tr>
                <tr>
                    <th>No Rekening</th>
                    <td> 
                        @if($order->no_rekening)
                        {{ $order->no_rekening }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Bukti Pembayaran</th>
                    <td>
                        @if($order->bukti_pembayaran)
                        <a href="#" class="lihat-gambar" data-bs-toggle="modal" data-bs-target="#modalGambar" data-image="{{ asset('storage/' . $order->bukti_pembayaran) }}">Lihat Bukti Pembayaran</a>
                        @else
                        -
                        @endif
                    </td>
                </tr>
                <tr>
                <tr>
                    <th>Image</th>
                    <td>
                        @if($order->image)
                        <a href="#" class="lihat-gambar" data-bs-toggle="modal" data-bs-target="#modalGambar" data-image="{{ asset('images/' . $order->image) }}">Lihat Gambar</a>
                        @else
                        Tidak Ada Gambar
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lihatGambarLinks = document.querySelectorAll('.lihat-gambar');
        lihatGambarLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var imageSource = link.getAttribute('data-image');
                var modalImage = document.getElementById('gambarModal');
                modalImage.src = imageSource;
            });
        });
    });
</script>
@endsection
