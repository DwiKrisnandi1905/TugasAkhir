<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .card-body {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            color: #fff;
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Reset Kata Sandi</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Alamat E-Mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim Tautan Reset Kata Sandi') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p><a href="{{ route('login') }}">Kembali ke login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
