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
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f5f5f5;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-color: #fff;
            color: #333;
            max-width: 700px;
            width: 100%;
        }
        .card-header {
            background: linear-gradient(to right, #ff8c00, #ff4500);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .form-control {
            border-radius: 0;
            border: 1px solid #ddd;
            box-shadow: none;
            background-color: #fff;
            color: #333;
        }
        .form-control:focus {
            border-color: #FFA500;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #FF6347;
            border: none;
            border-radius: 4px;
            width: 100%;
            color: #fff;
            padding: 10px;
        }
        .btn-primary:hover {
            background-color: #FF4500;
        }
        .card-footer {
            background-color: #f8f9fa;
            border-radius: 0 0 15px 15px;
            padding: 10px 20px;
            text-align: center;
        }
        .card-footer a {
            color: #FF6347;
            text-decoration: none;
        }
        .card-footer a:hover {
            text-decoration: underline;
        }
        .alert {
            margin-bottom: 15px;
        }
        .left-column {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 15px 0 0 15px;
        }
        .left-column img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 15px 0 0 15px;
        }
        .right-column {
            padding: 20px;
        }
        h3 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-6 left-column">
                <img src="images/fpw.svg" alt="forget-password">
            </div>
            <div class="col-md-6 right-column">
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
                                {{ __('Kirim Tautan ke Email') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p><a href="{{ route('login') }}" class="fw-bold">Kembali ke login</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
