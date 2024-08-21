<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/6.0.0/css/ionicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css')}}">
       
</head>
<body>
    <div class="login-page">
    <div class="login-container">
        <div class="text-center mb-4">
            <ion-icon name="log-in-outline" style="font-size: 48px;"></ion-icon> <!-- Ikon Login -->
        </div>
        <div class="text-login">
            <h3>Login</h3>
            <p>Silahkan masukkan email dan password Anda </p>
        </div>

        <div id="error-message" class="alert alert-danger d-none"></div>
        <form id="login-form">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    placeholder=" Masukan Email"
                    name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    placeholder=" Masukan Password"
                    name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
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
                // Asumsikan bahwa response.data mengandung data user dan token
                let user = response.data.user; // Ambil data user dari respons API
                let token = response.data.token; // Ambil token dari respons API

                // Simpan token dan user di localStorage
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user)); // Simpan data user sebagai JSON string

                // Arahkan pengguna ke halaman dashboard setelah login
                window.location.href = '/dashboard';
            })
            .catch(function(error) {
                // Tangani kesalahan login
                let errorMessage = document.getElementById('error-message');
                errorMessage.classList.remove('d-none');
                errorMessage.textContent = error.response.data.error;
            });

        });
    </script>
</body>
</html>
