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

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 5%;
        }


        #home {
            position: relative;
            color: #fff;
        }

        #home .carousel-inner {
            height: 100vh;
        }

        #home .carousel-item {
            height: 100vh;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            position: relative;
        }

        #home .carousel-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }

        #home .carousel-caption {
            z-index: 2;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 10px;
            position: relative;
            top: 40%;
            left: 0%;
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

        .card-img-top {
            height: 200px; 
            object-fit: cover;
            padding: 2%;
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
                        <a class="nav-link" href="#products" onclick="setActive(this)">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" onclick="setActive(this)">Tentang Kami</a>
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
    <section id="home" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('images/bg.jpg');">
                <div class="carousel-caption d-flex-center">
                    <div>
                        <h1>Selamat Datang di <span class="orange fw-bold">Alveen Clothing</span></h1>
                        <p class="lead fst-italic">"Wear Your Confidence"</p>
                        <a href="{{ route('login') }}" class="btn">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Produk</h2>
            <div class="row">
                <!-- Product 1 -->
                <div class="col-md-4 mb-4 mx-auto">
                    <div class="card">
                        <img src="images/1718171245_foto_produk_modal_0.jpg" class="card-img-top" alt="Product 1">
                        <div class="card-body">
                            <h5 class="card-title text-center">Toko Baju</h5>
                            <a href="{{ route('login') }}" class="btn">Lihat Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="col-md-4 mb-4 mx-auto">
                    <div class="card">
                        <img src="images/1718171245_foto_produk_modal_0.jpg" class="card-img-top" alt="Product 2">
                        <div class="card-body">
                            <h5 class="card-title text-center">Konveksi Baju</h5>
                            <a href="{{ route('login') }}" class="btn">Lihat Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Tentang Kami</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <img src="images/about.jpg" class="img-fluid rounded" alt="Tentang Kami">
                </div>
                <div class="col-md-6">
                    <p class="text-justify">Alveen Clothing adalah sebuah toko pakaian dan penyedia jasa konveksi baju yang terletak di daerah Tembalang, sebuah kawasan yang dinamis di Kota Semarang. Kami tidak hanya menyediakan berbagai pilihan pakaian berkualitas tinggi, tetapi juga menawarkan layanan konveksi yang handal dan profesional. Lokasi kami yang strategis memudahkan pelanggan untuk mengakses toko kami, baik dari pusat kota maupun dari daerah sekitarnya. Di Alveen Clothing, kami berkomitmen untuk memberikan produk dan layanan terbaik, memastikan setiap pelanggan puas dengan pengalaman berbelanja dan hasil konveksi yang mereka terima</p>
                    <p class="text-justify">Dengan fokus pada inovasi dan kualitas, Alveen Clothing terus berkembang dan beradaptasi dengan tren fashion terbaru. Kami bekerja sama dengan desainer berbakat dan menggunakan bahan-bahan pilihan untuk menciptakan produk yang tidak hanya nyaman dipakai, tetapi juga bergaya. Layanan konveksi kami mencakup berbagai kebutuhan, mulai dari seragam perusahaan, pakaian olahraga, hingga baju casual.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 text-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-black">Hubungi Kami</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="Tulis pesan Anda di sini"></textarea>
                </div>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- FAQ Section -->
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
    <footer class="footer-custom py-4">
        <div class="container text-center">
            <p>&copy; 2024 Alveen Clothing. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function setActive(element) {
            var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navLinks.forEach(function(navLink) {
                navLink.classList.remove('active');
            });
            element.classList.add('active');
        }

        var carousel = new bootstrap.Carousel('#home');
    </script>
</body>
</html>
