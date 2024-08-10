<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h3 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
            text-align: center;
        }
        .login-container .form-control {
            height: 45px;
            font-size: 16px;
        }
        .login-container .btn {
            padding: 10px;
            font-size: 16px;
        }
        @media (max-width: 576px) {
            .login-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Login</h3>
        <div id="error-message" class="alert alert-danger d-none"></div>
        <form id="login-form">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        {{-- <div class="text-center mt-3">
            <small>Don't have an account? <a href="{{ route('register') }}">Sign up</a></small>
        </div> --}}
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            
            axios.post('{{ url("/api/login") }}', {
                email: email,
                password: password
            })
            .then(function(response) {
                // Handle successful login
                window.location.href = '/dashboard';
            })
            .catch(function(error) {
                // Handle login error
                let errorMessage = document.getElementById('error-message');
                errorMessage.classList.remove('d-none');
                errorMessage.textContent = error.response.data.error;
            });
        });
    </script>
</body>
</html>
