<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }

        .d-flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar {
            background: linear-gradient(to right, #FFA500, #FF6347);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link.active {
            color: #fff;
            font-weight: bold;
        }

        .btn {
            color: #fff;
            background-color: #FF6347;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            border: 2px solid #fff; 
        }

        .btn:hover {
            color: #FF6347;
            background-color: #fff;
        }

        .bg-primary-custom {
            background: linear-gradient(to right, #FFA500, #FF6347);
            color: #fff;
        }

        .bg-light-custom {
            background-color: #f8f9fa;
        }

        .footer-custom {
            background-color: #343a40;
            color: #fff;
        }

        .team-member {
            margin-bottom: 30px;
        }

        .team-member img {
            border-radius: 50%;
        }

        .team-member h5 {
            margin-top: 15px;
            font-weight: bold;
        }

        .team-member p {
            color: #666;
        }

        #home {
            background-image: url('/bg2.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            color: #fff;
        }

        #home .container {
            background: rgba(0, 0, 0, 0.5);
            padding: 50px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>   
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home" onclick="setActive(this)">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" onclick="setActive(this)">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products" onclick="setActive(this)">Produk Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact" onclick="setActive(this)">Hubungi Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-people"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="py-5 text-center min-vh-100 d-flex-center">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Website Kami</h1>
            <p class="lead">Ini adalah halaman home dari website kami.</p>
            <a href="{{ route('login') }}" class="btn">Mulai Sekarang</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 min-vh-100 d-flex-center bg-light-custom">
        <div class="container">
            <h2 class="text-center mb-5">Tentang Kami</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Visi Kami</h3>
                    <p>Menjadi pemimpin dalam industri kami dengan inovasi dan kualitas terbaik.</p>
                    <h3>Misi Kami</h3>
                    <ul>
                        <li>Menyediakan produk dan layanan berkualitas tinggi kepada pelanggan.</li>
                        <li>Membangun hubungan yang kuat dengan komunitas dan lingkungan.</li>
                        <li>Mendorong inovasi dan kreativitas di setiap aspek bisnis kami.</li>
                    </ul>
                    <h3>Nilai-Nilai Kami</h3>
                    <ul>
                        <li>Integritas</li>
                        <li>Komitmen</li>
                        <li>Inovasi</li>
                        <li>Kerjasama</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Sejarah Kami</h3>
                    <p>Kami didirikan pada tahun 2000 dengan tujuan untuk memberikan solusi terbaik bagi pelanggan kami. Sejak saat itu, kami telah berkembang menjadi salah satu perusahaan terkemuka di industri kami, dengan tim yang terdiri dari para profesional yang berdedikasi.</p>
                    <h3>Tim Kami</h3>
                    <div class="row">
                        <div class="col-sm-4 team-member">
                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member 1">
                            <h5>John Doe</h5>
                            <p>CEO</p>
                        </div>
                        <div class="col-sm-4 team-member">
                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member 2">
                            <h5>Jane Smith</h5>
                            <p>CTO</p>
                        </div>
                        <div class="col-sm-4 team-member">
                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member 3">
                            <h5>Mike Johnson</h5>
                            <p>CFO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5 bg-light-custom min-vh-100">
        <div class="container text-center">
            <h2>Produk Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 1">
                        <div class="card-body">
                            <h5 class="card-title">Produk 1</h5>
                            <p class="card-text">Deskripsi singkat produk 1.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 2">
                        <div class="card-body">
                            <h5 class="card-title">Produk 2</h5>
                            <p class="card-text">Deskripsi singkat produk 2.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 3">
                        <div class="card-body">
                            <h5 class="card-title">Produk 3</h5>
                            <p class="card-text">Deskripsi singkat produk 3.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 min-vh-100 d-flex-center bg-light-custom">
        <div class="container">
            <h2 class="text-center">Hubungi Kami</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 footer-custom text-center">
        <div class="container">
            <p>&copy; 2023 Perusahaan Anda. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap 5.3.0 JS Bundle CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function setActive(element) {
            const links = document.querySelectorAll('.navbar-nav .nav-link');
            links.forEach(link => link.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
</body>
</html>
