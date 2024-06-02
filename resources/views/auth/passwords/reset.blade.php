<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Kata Sandi</title>
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
        .form-check-input {
            margin-top: 5px;
        }
        .form-check-label {
            margin-left: 5px;
            color: rgba(255, 255, 255, 0.7);
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            color: #fff;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .card-footer {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0 0 15px 15px;
            padding: 10px 20px;
            text-align: center;
        }
        .card-footer a {
            color: #fff;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Kata Sandi') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        <button class="btn toggle-password" type="button" data-input="password"><i class="far fa-eye-slash"></i></button>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Kata Sandi') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <button class="btn toggle-password" type="button" data-input="password_confirmation"><i class="far fa-eye-slash"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Kata Sandi') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
