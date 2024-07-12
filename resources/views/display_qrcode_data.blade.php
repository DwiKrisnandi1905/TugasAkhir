<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .product-image {
            max-width: 300px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>{{ $data['judul'] }}</h1>
    <h2>{{ $data['nama_produk'] }}</h2>
    <h2>{{ $data['type_produk'] }}</h2>
    <img src="{{ $data['foto_produk'] }}" alt="Foto Produk" class="product-image">
    {{-- <p>Total Produk yang sudah digunakan: {{ $totalPesananTerjual }}</p> --}}
    <p>Token NFT: {{ $data['nft_token_id'] }}</p>
</body>
</html>
