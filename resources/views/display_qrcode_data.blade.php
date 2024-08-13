<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            background: orange; /* Mengubah warna latar belakang menjadi oranye */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            text-align: center;
            overflow: hidden;
        }
        h1, h2, p {
            color: white; /* Mengubah warna teks menjadi putih */
        }
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .product-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            word-wrap: break-word;
        }
        .token-id {
            word-break: break-all;
            white-space: pre-wrap;
        }
        @media (min-width: 600px) {
            .product-details {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }
            .product-image {
                max-width: 300px;
                margin-right: 20px;
                margin-bottom: 0;
            }
            .product-info {
                text-align: left;
            }
        }
        @media (min-width: 900px) {
            body {
                padding: 40px;
            }
            .container {
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $data['judul'] }}</h1>
        <div class="product-details">
            <img src="{{ $data['foto_produk'] }}" alt="Foto Produk" class="product-image">
            <div class="product-info">
                <h2>{{ $data['nama_produk'] }}</h2>
                <h2>{{ $data['type_produk'] }}</h2>
                <p class="token-id">Token NFT: {{ $data['nft_token_id'] }}</p>
            </div>
        </div>
    </div>
</body>
</html>
