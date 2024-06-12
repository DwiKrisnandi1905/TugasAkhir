<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .orange {
            color: #FF6347;
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
            border: 2px solid #FF6347;
        }

        .bg-primary-custom {
            background: linear-gradient(to right, #FFA500, #FF6347);
            color: #fff;
        }

        .bg-light-custom {
            background-color: #f8f9fa;
        }

        .bg-dark-custom {
            background-color: #343a40;
            color: #fff;
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

        .form-label, .black {
            color: #000;
        }

        .form-control {
            background-color: #c2bfbf;
        }

        .team-member p {
            color: #666;
        }

        .accordion-header button {
            font-weight: bold;
            color: black;
        }

        .accordion-header button:not(.collapsed) {
            background-color: #ff9a27;
        }

        #home {
            background-image: url('images/bg3.jpg'); 
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            color: #fff;
            position: relative;
        }

        #home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        #home .container {
            position: relative;
            z-index: 2;
            background: rgba(0, 0, 0, 0.5);
            padding: 50px;
            border-radius: 10px;
        }

        #products {
            background-color: #f0f0f0; /* Light gray background for Products section */
        }

        #about {
            background-color: #fff; /* White background for About section */
        }

        #contact {
            background: #e74900;
        }

        #contact .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 6px 6px rgba(0, 0, 0, 1);
        }

        #faq {
            background-color: #f0f0f0; /* Light gray background for Q&A section */
        }

        #faq .accordion-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><i class="fas fa-tshirt"></i></a>
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
                        <a class="nav-link" href="#products" onclick="setActive(this)">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact" onclick="setActive(this)">Hubungi Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq" onclick="setActive(this)">FAQ</a>
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
            <h1 class="display-4">Selamat Datang di <span class="orange fw-bold">Alveen Clothing</span></h1>
            <p class="lead fst-italic">"Wear Your Confidence"</p>
            <a href="{{ route('login') }}" class="btn">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5 bg-light-custom min-vh-100">
        <div class="container text-center">
            <h2 class="mb-5 fw-bold">Produk Kami</h2>
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

    <!-- Contact Section -->
    <section id="contact" class="py-5 min-vh-100 d-flex-center">
        <div class="container">
            <h2 class="text-center black">Hubungi Kami</h2>
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
                <button type="submit" class="btn">Kirim</button>
            </form>
        </div>
    </section>

    <!-- Q&A -->
    <section id="faq" class="py-5 bg-light-custom">
        <div class="accordion accordion-flush bg-light-custom mx-5" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Dimana letak Alveen Clothing ?
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Alveen Clothing terletak di Tembalang.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Mengapa harus Alveen Clothing ?
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Alveen Clothing menawarkan produk dengan kualitas tinggi yang terjamin. Bahan-bahan yang dipilih dengan cermat dan perhatian terhadap detail dalam desain membuat setiap produk menjadi nilai investasi yang baik bagi konsumen.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    No. Telepon yang bisa dihubungi ?
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Jangan segan menghubungi kami pada +62-888-888-888.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 footer-custom text-center">
        <div class="container">
            <p>&copy; 2024 Alveen Clothing. Semua hak dilindungi.</p>
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
