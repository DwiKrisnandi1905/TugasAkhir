@extends('Pelanggan.Layout.index')

@section('content')
<style>
    .custom-nav-tabs .nav-item {
        flex: 1;
    }
    .custom-nav-tabs .nav-link {
        border-radius: 0;
        margin: 0;
        padding: .75rem 1rem;
        color: #fff;
        background-color: #ff7f50;
        transition: background-color 0.3s, transform 0.3s;
        font-weight: bold;
        text-align: center;
    }
    .custom-nav-tabs .nav-link i {
        margin-right: .5rem;
    }
    .custom-nav-tabs .nav-link.active {
        background-color: #ff4500;
    }
    .custom-nav-tabs .nav-link:hover {
        background-color: #ff6347;
        color: #fff;
        transform: scale(1.05);
    }
    .custom-nav-tabs .nav-link:focus {
        box-shadow: 0 0 0 .25rem rgba(255, 99, 71, .5);
    }
    .custom-nav-tabs .nav-link.active:focus {
        box-shadow: 0 0 0 .25rem rgba(255, 69, 0, .5);
    }
    .card {
        border: none;
        border-radius: .5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
        transition: transform 0.3s;
        display: flex;
        min-height: 150px;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-body {
        padding: 1.5rem;
        border: 2px solid #ff7f50;
        border-radius: .5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 1;
    }
    .card-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #333;
    }
    .card-text {
        font-size: 1rem;
        color: #6c757d;
    }
    .card-img {
        max-width: 240px;
        max-height: 240px;
        object-fit: cover;
    }
    .card-content {
        border: 2px solid #ff7f50;
        display: flex;
        flex: 1;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
        padding: 8px;
    }
    .card-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-left: 1rem;
        flex: 1;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-status {
        text-align: right;
        color: #ff7f50;
        font-weight: bold;
    }
    .card-detail-link {
        text-align: right;
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
    .card-detail-link:hover {
        text-decoration: underline;
    }
    @media (max-width: 576px) {
        .custom-nav-tabs .nav-link {
            padding: .5rem .75rem;
            font-size: .875rem;
        }
        .card-body {
            padding: 1rem;
        }
        .card-title {
            font-size: 1.25rem;
        }
        .card-text {
            font-size: .875rem;
        }
        .card {
            flex-direction: column;
            min-height: auto;
        }
        .card-img {
            max-width: 100px;
            max-height: 100px;
        }
        .card-details {
            margin-left: 0;
        }
    }
</style>
<div class="container mt-4">
    <ul class="nav nav-pills nav-justified custom-nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-pending-tab" data-bs-toggle="pill" data-bs-target="#pills-pending" type="button" role="tab" aria-controls="pills-pending" aria-selected="true">
                <i class="bi bi-hourglass-split"></i> Pending
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-diproses-tab" data-bs-toggle="pill" data-bs-target="#pills-diproses" type="button" role="tab" aria-controls="pills-diproses" aria-selected="false">
                <i class="bi bi-gear"></i> Diproses
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-dikirim-tab" data-bs-toggle="pill" data-bs-target="#pills-dikirim" type="button" role="tab" aria-controls="pills-dikirim" aria-selected="false">
                <i class="bi bi-truck"></i> Dikirim
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-selesai-tab" data-bs-toggle="pill" data-bs-target="#pills-selesai" type="button" role="tab" aria-controls="pills-selesai" aria-selected="false">
                <i class="bi bi-check-circle"></i> Selesai
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-dibatalkan-tab" data-bs-toggle="pill" data-bs-target="#pills-dibatalkan" type="button" role="tab" aria-controls="pills-dibatalkan" aria-selected="false">
                <i class="bi bi-x-circle"></i> Dibatalkan
            </button>
        </li>
    </ul>
    <div class="tab-content mt-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mb-3 text-primary" onclick="window.location='{{ route('profile') }}';">
                            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
                        </div>
                    </div>
                    @foreach($pesananPending as $pesanan)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanan->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanan->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['id' => $pesanan->id, 'type' => 'pesanan']) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanan->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanan->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanan->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanan->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanan->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanan->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($pesananKonveksiPending as $pesanans)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanans->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanans->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesananKonveksi', 'id' => $pesanans->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start text-start">
                                <strong>Warna:</strong> {{ $pesanans->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanans->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanans->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanans->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanans->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanans->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-diproses" role="tabpanel" aria-labelledby="pills-diproses-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mb-3 text-primary" onclick="window.location='{{ route('profile') }}';">
                            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
                        </div>
                    </div>
                    @foreach($pesananDiproses as $pesanan)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanan->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanan->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesanan', 'id' => $pesanan->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanan->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanan->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanan->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanan->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanan->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanan->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($pesananKonveksiDiproses as $pesanans)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanans->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanans->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesananKonveksi', 'id' => $pesanans->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanans->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanans->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanans->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanans->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanans->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanans->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-dikirim" role="tabpanel" aria-labelledby="pills-dikirim-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mb-3 text-primary" onclick="window.location='{{ route('profile') }}';">
                            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
                        </div>
                    </div>
                    @foreach($pesananDikirim as $pesanan)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanan->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanan->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesanan', 'id' => $pesanan->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanan->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanan->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanan->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanan->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanan->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanan->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($pesananKonveksiDikirim as $pesanans)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanans->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanans->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesananKonveksi', 'id' => $pesanans->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanans->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanans->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanans->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanans->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanans->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanans->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-selesai" role="tabpanel" aria-labelledby="pills-selesai-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mb-3 text-primary" onclick="window.location='{{ route('profile') }}';">
                            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
                        </div>
                    </div>
                    @foreach($pesananSelesai as $pesanan)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanan->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanan->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesanan', 'id' => $pesanan->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanan->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanan->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanan->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanan->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanan->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanan->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($pesananKonveksiSelesai as $pesanans)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanans->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanans->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesananKonveksi', 'id' => $pesanans->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanans->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanans->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanans->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanans->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanans->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanans->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-dibatalkan" role="tabpanel" aria-labelledby="pills-dibatalkan-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mb-3 text-primary" onclick="window.location='{{ route('profile') }}';">
                            <i class="bi bi-arrow-left-square-fill" style="cursor: pointer; font-size: 30px;"></i>
                        </div>
                    </div>
                    @foreach($pesananDibatalkan as $pesanan)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanan->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanan->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesanan', 'id' => $pesanan->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanan->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanan->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanan->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanan->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanan->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanan->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($pesananKonveksiDibatalkan as $pesanans)
                    <div class="card-content">
                        <img src="{{ asset('images/' . $pesanans->image) }}" alt="Product Image" class="card-img mx-2">
                        <div class="card-details">
                            <div class="card-header">
                                <h5 class="card-title">{{ $pesanans->nama_produk }}</h5>
                                <a href="{{ route('detailStatusPesanan', ['type' => 'pesananKonveksi', 'id' => $pesanans->id]) }}" class="card-detail-link">Detail</a>
                            </div>
                            <p class="card-text text-start">
                                <strong>Warna:</strong> {{ $pesanans->warna }}<br>
                                <strong>Ukuran:</strong> {{ $pesanans->ukuran }}<br>
                                <strong>Kuantitas:</strong> {{ $pesanans->kuantitas }}<br>
                                <strong>Harga Satuan:</strong> {{ $pesanans->harga_satuan }}<br>
                                <strong>Total Harga:</strong> {{ $pesanans->total_harga }}
                            </p>
                            <div class="card-footer">
                                <div></div>
                                <div class="card-status">{{ $pesanans->status }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5.3.0 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybH6VbJ8QIT5m8yLfeE3FELROUL6aI1XWrKj1dKC7lz18d3k" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-geQ5B5lOZmzJCcA3RCu7WIb5M1zV3Vj0LF0SA2FWzYvHGcVQ4G5KHKd9pX/E+cNB" crossorigin="anonymous"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
@endsection
