@extends('Pelanggan.Layout.index')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/bg.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/bg2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/bg3.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

<div class="row justify-content-between align-items-center mt-4 kategori-pencarian">
    <div class="col-md-auto">
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Kategori
            </button>
            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                <li><a class="dropdown-item" href="{{ route('home') }}">Semua Kategori</a></li>
                <li class="dropdown-header">Kategori Produk</li>
                @foreach($kategoriProduk as $kategori)
                    <li><a class="dropdown-item" href="{{ route('home', ['kategori' => $kategori->id, 'type' => 'produk']) }}">{{ $kategori->name }}</a></li>
                @endforeach
                <li class="dropdown-header">Kategori Konveksi</li>
                @foreach($kategoriKonveksi as $kategori)
                    <li><a class="dropdown-item" href="{{ route('home', ['kategori' => $kategori->id, 'type' => 'konveksi']) }}">{{ $kategori->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-auto">
        <form class="d-flex" role="search" method="GET" action="{{ route('home') }}">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->get('search', '') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
            <input type="hidden" name="type" value="{{ $type }}">
            @if (request()->has('kategori'))
                <input type="hidden" name="kategori" value="{{ request()->get('kategori') }}">
            @endif
        </form>
    </div>
</div>

<div class="recommendation-produk my-4">
    <h3 class="text-start">Rekomendasi Produk</h3>
</div>

@php
    $allProducts = ($type === 'all') ? array_merge($produks->all(), $konveksis->all()) : (($type === 'produk') ? $produks->all() : $konveksis->all());
    shuffle($allProducts);
@endphp

<div class="row row-cols-lg-5 row-cols-md-4 row-cols-2 mt-4">
    @foreach($allProducts as $product)
        <div class="col mb-4">
            <div class="card card-produk">
                <img src="{{ asset('images/' . $product->foto_produk) }}" class="card-img-top" alt="Product Image {{ $loop->iteration }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                    <p class="card-text">Rp {{ number_format($product->variasi->first()->highest_price, 2) }}</p>
                    @if ($product instanceof App\Models\Produk)
                        <a href="{{ route('detailTokobaju', $product->id) }}" class="btn btn-primary">Detail</a>
                    @elseif ($product instanceof App\Models\Konveksi)
                        <a href="{{ route('detailKonveksi', $product->id) }}" class="btn btn-primary">Detail</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
