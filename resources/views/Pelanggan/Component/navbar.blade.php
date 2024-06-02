<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-tshirt"></i></a>
        <div class="d-flex order-lg-2">
            <a href="/tokobajuu" class="nav-link mx-2 {{ Request::is('tokobajuu') ? 'active' : '' }}">Tokobaju</a>
            <a href="/konveksii" class="nav-link mx-2 {{ Request::is('konveksii') ? 'active' : '' }}">Konveksi</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class=" mx-2 nav-link {{ Request::is('home') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class=" mx-2 nav-link {{ Request::is('profile') ? 'active' : '' }}" href="/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="/cart" class="mx-2 nav-link {{ Request::is('cart') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
