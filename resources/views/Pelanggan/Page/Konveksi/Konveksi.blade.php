@extends('Pelanggan.Layout.index')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/800x400?text=First+Slide" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/800x400?text=Second+Slide" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/800x400?text=Third+Slide" class="d-block w-100" alt="...">
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
                <li><a class="dropdown-item" href="{{ route('konveksii') }}">Semua Kategori</a></li>
                @foreach($kategoris as $kategori)
                    <li><a class="dropdown-item" href="{{ route('konveksii', ['kategori' => $kategori->id]) }}">{{ $kategori->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-auto">
        <form class="d-flex" role="search" action="{{ route('konveksii') }}" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Search by name or price" aria-label="Search" value="{{ request()->search }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="recommendation-produk my-4">
    <h3 class="text-start">Rekomendasi Produk</h3>
</div>

<div class="row row-cols-lg-5 row-cols-md-4 row-cols-2 mt-4">
    @foreach($konveksis as $konveksi)
        <div class="col mb-4">
            <div class="card card-produk">
                <img src="{{ asset('images/' . $konveksi->foto_produk) }}" class="card-img-top" alt="Product Image {{ $loop->iteration }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $konveksi->nama_produk }}</h5>
                    <p class="card-text">Rp {{ number_format($konveksi->variasi->first()->highest_price, 2) }}</p>
                    <a href="{{ route('detailKonveksi', $konveksi->id) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
