<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 80px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: linear-gradient(to right, #FFA500, #FF6347);
            color: #fff;
        }
        .card-header {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .form-control {
            border-radius: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .form-control:focus {
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.15rem rgba(255, 255, 255, 0.25);
        }
        .btn-primary {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 4px;
            width: 100%;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .invalid-feedback {
            color: #ffc107;
        }
        .input-group {
            position: relative;
        }
        .input-group .btn {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            z-index: 10;
            color: #000;
        }
        .btn-link {
            color: #fff;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6 input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <button class="btn" type="button" id="togglePassword"><i class="far fa-eye-slash"></i></button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6 input-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <button class="btn" type="button" id="togglePassword"><i class="far fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('password.request') }}" class="btn btn-link">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var passwordInput = document.querySelector('input[name="password"]');
        var togglePasswordButton = document.getElementById('togglePassword');
        
        if (passwordInput && togglePasswordButton) {
            togglePasswordButton.addEventListener('click', function() {
                var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
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
