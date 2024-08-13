<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        .card-header {
            background-color: #ff7043;
            color: white;
            border-bottom: none;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 1rem;
        }
        .card-body {
            padding: 2rem;
            background-color: #fff8f5;
        }
        .btn-link {
            color: #ff7043;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        .alert-success {
            background-color: #ffd5c2;
            border: none;
            color: #ff7043;
            border-radius: 5px;
            padding: 1rem;
            text-align: center;
        }
        .footer-link {
            margin-top: 2rem;
            text-align: center;
        }
        .footer-link a {
            color: #ff7043;
            text-decoration: none;
            font-weight: bold;
        }
        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifikasi Alamat Email Anda') }}</div>
                    <div class="card-body">
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </div>
                        @endif
                        <p class="mb-3">{{ __('Sebelum melanjutkan, harap periksa email Anda untuk link verifikasi.') }}</p>
                        <p class="mb-3">{{ __('Jika Anda tidak menerima email tersebut') }},</p>
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk mengirim ulang') }}</button>.
                        </form>
                        <div class="footer-link mt-4">
                            <p>Sudah Aktivasi? <a href="{{ route('home') }}" class="fw-bold">click disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
