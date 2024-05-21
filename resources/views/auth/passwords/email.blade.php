<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
    
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="card-footer text-center">
                        <a href="{{ route('login') }}" class="btn btn-link">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
