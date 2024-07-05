<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>History Report</h1>

    <h2>Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tgl. Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Status</th>
                <th>Total</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesananSelesaiDibatalkan as $pesanan)
                <tr>
                    <td>{{ $pesanan->id }}</td>
                    <td>{{ $pesanan->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pesanan->user->name }}</td>
                    <td>{{ $pesanan->nama_produk }}</td>
                    <td>{{ ucfirst($pesanan->status) }}</td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $pesanan->kuantitas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Pesanan Konveksi</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tgl. Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Status</th>
                <th>Total</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesananKonveksiSelesaiDibatalkan as $pesananKonveksi)
                <tr>
                    <td>{{ $pesananKonveksi->id }}</td>
                    <td>{{ $pesananKonveksi->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pesananKonveksi->user->name }}</td>
                    <td>{{ $pesananKonveksi->nama_produk }}</td>
                    <td>{{ ucfirst($pesananKonveksi->status) }}</td>
                    <td>Rp {{ number_format($pesananKonveksi->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $pesananKonveksi->kuantitas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>