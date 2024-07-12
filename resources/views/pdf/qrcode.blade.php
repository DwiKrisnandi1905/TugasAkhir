<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Code PDF</title>
    <style>
        body {
            font-family: DejaVu Sans;
            text-align: center;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Alveen Clothing</h1>
    <h2>{{ $produk->nama_produk }}</h2>
    <p>Type Produk: {{ $produk->type_produk }}</p>
    <p>Kategori: {{ $produk->kategori->name }}</p>
    <p>Deskripsi: {{ $produk->deskripsi_produk }}</p>
    <p>Tanggal Masuk: {{ $produk->tanggal_masuk }}</p>
    <p>Token NFT: {{ $produk->nft_token_id }}</p>
    {{-- <img src="{{ asset('images/' . $produk->foto_produk) }}" alt="Foto Produk"> --}}

    <div class="qr-code">
        <p>QRCODE Token NFT Blockchain</p>
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
    </div>
</body>
</html>
