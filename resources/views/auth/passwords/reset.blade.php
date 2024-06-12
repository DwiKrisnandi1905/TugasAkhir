<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 9vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(to right, #FFA500, #FF6347);
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            background-color: #fff;
            color: #000; 
            padding: 40px 30px;
        }
        .card-footer {
            background-color: #f8f9fa;
            border-radius: 0 0 15px 15px;
            padding: 10px 20px;
            text-align: center;
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
        .form-label {
            color: rgba(0, 0, 0, 0.8);
        }
        .btn-primary {
            background-color: rgba(255, 69, 0, 0.8);
            border: none;
            border-radius: 4px;
            width: 100%;
            color: #fff;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: rgba(255, 69, 0, 1);
        }
        .form-check-input {
            margin-top: 5px;
        }
        .form-check-label {
            margin-left: 5px;
            color: rgba(0, 0, 0, 0.7);
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            color: #ff4500;
            text-decoration: none;
            transition: text-decoration 0.3s;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .card-footer a {
            color: #FF6347;
            text-decoration: none;
        }
        .card-footer a:hover {
            text-decoration: underline;
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
            background: #f5f5f5;
            padding: 20px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="card-header mb-3 border-rounded">
                                    <h3>Reset Kata Sandi</h3>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bolder">Alamat E-Mail</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-bolder">Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                                            <button class="btn" type="button" id="togglePassword"><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label fw-bolder">Konfirmasi Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                                            <button class="btn" type="button" id="toggleConfirmPassword"><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary fw-bolder">Reset Kata Sandi</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p>Ingat kata sandi Anda? <a href="{{ route('login') }}" class="fw-bold">Login</a></p>
                            </div>
                        </div>
                        <div class="col-md-6 image-container">
                            <img src="/images/reset.svg" alt="reset">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var passwordInput = document.querySelector('input[name="password"]');
            var confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
            var togglePasswordButton = document.getElementById('togglePassword');
            var toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');

            if (passwordInput && togglePasswordButton && confirmPasswordInput && toggleConfirmPasswordButton) {
                togglePasswordButton.addEventListener('click', function() {
                    var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        this.innerHTML = '<i class="far fa-eye-slash"></i>';
                    } else {
                        this.innerHTML = '<i class="far fa-eye"></i>';
                    }
                });

                toggleConfirmPasswordButton.addEventListener('click', function() {
                    var type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPasswordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        this.innerHTML = '<i class="far fa-eye-slash"></i>';
                    } else {
                        this.innerHTML = '<i class="far fa-eye"></i>';
                    }
                });
            }
        });
    </script>
</body>
</html>
