<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { max-width: 400px; margin: 50px auto; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .alert-success { text-align: center; }
        .btn { width: 100%; }
        .btn-primary { background-color: #007bff; border-color: #007bff; }
        .input-group { position: relative; }
        .input { border: solid 1.5px #9e9e9e; background: none; padding: 10px; font-size: 16px; color: #212121; }
        .label { position: absolute; left: 15px; color: #9e9e9e; pointer-events: none; transform: translateY(10px); font-size: 18px; transition: 150ms cubic-bezier(0.4, 0, 0.2, 1); }
        .input:focus, .input:valid { outline: none; border: 1.5px solid #007bff; }
        .input:focus ~ .label, .input:valid ~ .label { transform: translateX(-10%) translateY(-50%) scale(0.9); background-color: #fff; padding: 0 0.2em; color: #007bff; z-index: 10; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <h1 class="card-title text-center">Forgot Password</h1>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" id="email" name="email" class="form-control input" required>
                                <label for="email" class="form-label label">Email:</label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                            </div>
                        </form>
                        <div class="register-link d-flex justify-content-between" style="font-size: 14px;">
                            <p><a href="{{ route('login') }}">Back to login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
