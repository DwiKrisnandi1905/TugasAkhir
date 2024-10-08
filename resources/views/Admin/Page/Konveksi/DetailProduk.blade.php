@extends('admin.layout.index')

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
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#mainImageModal" style="text-decoration: none; color: #FFF; background-color: #000; padding-left: 10px; padding-right: 10px; border-radius: 8px;">{{ $konveksis->foto_produk }}</a>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">Total Terjual</th>
                    <td>{{ $totalTerjual }}</td>
                </tr>
                {{-- <tr>
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
                </tr> --}}
                <tr>
                    <th scope="row" class="col-4">Deskripsi</th>
                    <td id="deskripsi">{{ $konveksis->deskripsi }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-4">Token NFT</th>
                    <td id="deskripsi">{{ $konveksis->nft_token_id }}</td>
                </tr>
                {{-- <tr>
                    <th scope="row" class="col-4">QRcode Token NFT</th>
                    <td id="deskripsi">
                      @if(isset($konveksis->nft_token_id))
                        <div>{!! QrCode::size(200)->generate($konveksis->nft_token_id) !!}</div>
                      @else
                        <p>QR code tidak tersedia</p>
                      @endif
                    </td>
                </tr> --}}
                <tr>
                    <th scope="row" class="col-4">QRcode Token NFT</th>
                    <td id="qrcode">
                        @if(isset($konveksis->nft_token_id))
                        @php
                            $qrData = [
                                'judul' => 'Alveen Clothing',
                                'nama_produk' => $konveksis->nama_produk,
                                // 'type_produk' => $konveksis->type_produk,
                                'foto_produk' => asset('images/' . $konveksis->foto_produk),
                                'nft_token_id' => $konveksis->nft_token_id
                            ];
            
                            $qrCodeUrl = route('displayQRCodeDataKonveksi', ['data' => json_encode($qrData)]);
                        @endphp
                        <div>{!! QrCode::size(200)->generate($qrCodeUrl) !!}</div>
                        @else
                            <p>QR code tidak tersedia</p>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mb-3 justify-content-center d-flex gap-4">
            <a href="{{ route('editProdukKonveksi', ['id' => $konveksis->id]) }}" class="btn btn-success w-75 fw-bold">Edit</a>
            <a href="{{ route('generateQRCodePDFKonveksi', ['id' => $konveksis->id]) }}" class="btn btn-primary w-75 fw-bold">Download PDF</a>
        </div>
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
                    {{-- <th scope="col">Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($variasiProdukKonveksi as $variasiProduk)
                <tr>
                    <th scope="row">{{ $variasiProduk->warna_produk }}</th>
                    <th class="ukuran">{{ $variasiProduk->ukuran }}</th>
                    <td class="harga">{{ $variasiProduk->harga }}</td>
                    <td class="stock">{{ $variasiProduk->stock }}</td>
                    <td class="gambar">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalImageModal_{{ $variasiProduk->id }}" style="text-decoration: none; color: #FFF; background-color: #000; padding-left: 10px; padding-right: 10px; border-radius: 8px;">{{ $variasiProduk->foto_produk_modal }}</a>
                    </td>
                    <td>{{$totalVariasiTerjual}}</td>
                </tr>

                <!-- Modal for Variasi Images -->
                <div class="modal fade" id="modalImageModal_{{ $variasiProduk->id }}" tabindex="-1" aria-labelledby="modalImageModalLabel_{{ $variasiProduk->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalImageModalLabel_{{ $variasiProduk->id }}">Foto Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('images/' . $variasiProduk->foto_produk_modal) }}" alt="Foto Produk Modal" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
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
                <img src="{{ asset('images/' . $konveksis->foto_produk) }}" alt="Foto Produk" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection
