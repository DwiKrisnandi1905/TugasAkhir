@extends('Pelanggan.Layout.index')

@section('content')
<div class="container mt-4">
    <!-- Centered Navigation Tabs -->
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
                    <h3 class="card-title text-center">Pending</h3>
                    <p class="card-text text-center">Content for pending section.</p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-diproses" role="tabpanel" aria-labelledby="pills-diproses-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title text-center">Diproses</h3>
                    <p class="card-text text-center">Content for diproses section.</p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-dikirim" role="tabpanel" aria-labelledby="pills-dikirim-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title text-center">Dikirim</h3>
                    <p class="card-text text-center">Content for dikirim section.</p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-selesai" role="tabpanel" aria-labelledby="pills-selesai-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title text-center">Selesai</h3>
                    <p class="card-text text-center">Content for selesai section.</p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-dibatalkan" role="tabpanel" aria-labelledby="pills-dibatalkan-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title text-center">Dibatalkan</h3>
                    <p class="card-text text-center">Content for dibatalkan section.</p>
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

<!-- Custom CSS -->
<style>
    .custom-nav-tabs .nav-item {
        flex: 1;
    }
    .custom-nav-tabs .nav-link {
        border-radius: 0;
        margin: 0;
        padding: .75rem 1rem;
        color: #fff;
        background-color: #ff7f50; /* Coral color for tabs */
        transition: background-color 0.3s, transform 0.3s;
        font-weight: bold;
        text-align: center;
    }
    .custom-nav-tabs .nav-link i {
        margin-right: .5rem;
    }
    .custom-nav-tabs .nav-link.active {
        background-color: #ff4500; /* OrangeRed color for active tab */
    }
    .custom-nav-tabs .nav-link:hover {
        background-color: #ff6347; /* Tomato color for hover effect */
        color: #fff;
        transform: scale(1.05);
    }
    .custom-nav-tabs .nav-link:focus {
        box-shadow: 0 0 0 .25rem rgba(255, 99, 71, .5); /* Tomato color for focus */
    }
    .custom-nav-tabs .nav-link.active:focus {
        box-shadow: 0 0 0 .25rem rgba(255, 69, 0, .5); /* OrangeRed color for active focus */
    }
    .card {
        border: none;
        border-radius: .5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
        transition: transform 0.3s;
        min-height: 70vh;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-body {
        padding: 2rem;
        border: 2px solid #ff7f50;
        border-radius: .5rem;
    }
    .card-title {
        font-size: 1.75rem;
        margin-bottom: 1rem;
        color: #333;
    }
    .card-text {
        font-size: 1rem;
        color: #6c757d;
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
            font-size: 1.5rem;
        }
        .card-text {
            font-size: .875rem;
        }
    }
</style>
@endsection
