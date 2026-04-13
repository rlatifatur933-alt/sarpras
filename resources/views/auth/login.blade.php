<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SARPRASIN') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-sarprasin.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #ebf3ff; 
            height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Nunito', sans-serif;
        }
        .login-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .btn-mazer {
            background-color: #435ebe; 
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-mazer:hover {
            background-color: #25396f;
            color: white;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #435ebe;
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
        }
        .brand-icon {
            color: #435ebe;
            font-size: 3rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                    <div class="brand-icon mb-2">
                        <img src="{{ asset('img/logo-sarprasin.png') }}" alt="Logo" style="width: 60px;">
                    </div>
                        <h3 class="fw-bold" style="color: #25396f;">Log In</h3>
                        <p class="text-muted small">Input your data to register to our website.</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger py-2 small border-0 text-center">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ url('login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label class="form-label small text-secondary">Username / Email</label>
                            <input type="text" name="login_identity" class="form-control" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label class="form-label small text-secondary">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        
                        <div class="form-check mb-4 small">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-secondary" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>

                        <button type="submit" class="btn btn-mazer w-100 shadow-lg">Log in</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="small text-muted">Don't have an account? <a href="#" style="color: #435ebe;" class="fw-bold text-decoration-none">Sign up</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>