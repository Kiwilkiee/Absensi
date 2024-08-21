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
                let user = response.data.user; 
                let userId = response.user.id;
                let token = response.data.token; // Ambil token dari respons API

                // Simpan token dan user di localStorage
               // Bersihkan data absensi lama
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user)); 
                localStorage.setItem('userId', user )// Simpan data user sebagai JSON string

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