<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Toko Baju</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tgl. Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk/Layanan</th>
                <th>Status Pengiriman</th>
                <th>Total</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->nama_produk }}</td>
                    <td>{{ $order->status }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->kuantitas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Konveksi</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tgl. Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk/Layanan</th>
                <th>Status Pengiriman</th>
                <th>Total</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesananKonveksi as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->nama_produk }}</td>
                    <td>{{ $order->status }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->kuantitas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>