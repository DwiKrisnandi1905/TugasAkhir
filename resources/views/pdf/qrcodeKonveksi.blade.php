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
    <h1>{{ $konveksi->nama_produk }}</h1>
    <p>Kategori: {{ $konveksi->kategori->name }}</p>
    <p>Deskripsi: {{ $konveksi->deskripsi }}</p>
    <p>Tanggal Masuk: {{ $konveksi->tanggal_masuk }}</p>
    <p>Token NFT: {{ $konveksi->nft_token_id }}</p>

    <div class="qr-code">
        <p>QRCODE Token NFT Blockchain</p>
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
    </div>
</body>
</html>