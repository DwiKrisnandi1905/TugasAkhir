<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 6%;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(to right, #FFA500, #FF6347);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            background-color: #fff;
            color: #000; 
            padding: 40px 30px;
        }
        .form-control {
            border-radius: 5px;
            border: none;
            box-shadow: none;
            background-color: #f3f3f3;
            color: #000;
        }
        .form-control:focus {
            border-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 0 0.15rem rgba(0, 0, 0, 0.25);
        }
        .btn-primary {
            background-color: rgba(255, 99, 71, 0.8);
            border: none;
            border-radius: 4px;
            width: 100%;
            color: #fff;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: rgba(255, 99, 71, 1);
        }
        .card-footer {
            background-color: #f8f9fa;
            border-radius: 0 0 15px 15px;
            padding: 10px 20px;
            text-align: center;
        }
        .card-footer a {
            color: #ff6347;
            text-decoration: none;
        }
        .card-footer a:hover {
            text-decoration: underline;
        }
        .input-group {
            position: relative;
        }
        .input-group .btn {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            border: none;
            background: transparent;
            z-index: 10;
            color: #000;
        }
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #FFA500, #FF6347);
            border-radius: 15px 0 0 15px;
            padding: 20px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
        .back-arrow {
            display: flex;
            align-items: center;
            color: #ff6347;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .back-arrow:hover {
            text-decoration: underline;
        }
        .back-arrow i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/" class="back-arrow"><i class="fas fa-arrow-left"></i> Landing Page</a>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-6 image-container">
                            <img src="images/register.svg" alt="Register Image">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="card-header mb-3 border-rounded">
                                    <h3>Form Register</h3>
                                </div>
                                <!-- Alert messages -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            <button class="btn toggle-password" type="button" data-input="password"><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                                            <button class="btn toggle-password" type="button" data-input="password_confirmation"><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p>Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold">Login disini</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleButtons = document.querySelectorAll('.toggle-password');
            
            toggleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var input = document.querySelector('input[name="' + this.dataset.input + '"]');
                    var type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    if (type === 'password') {
                        this.innerHTML = '<i class="far fa-eye-slash"></i>';
                    } else {
                        this.innerHTML = '<i class="far fa-eye"></i>';
                    }
                });
            });
        });
    </script>
</body>
</html>
