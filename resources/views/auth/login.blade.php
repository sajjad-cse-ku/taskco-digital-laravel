<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | My App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .login-container {
            min-height: 100vh;
        }

        .login-box {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.06);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container login-container d-flex justify-content-center align-items-center">
    <div class="col-md-5 col-lg-4 login-box">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">🔐 Login</h2>
            <p class="text-muted small">Access your account securely</p>
        </div>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
