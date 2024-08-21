<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Absensi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 20px;
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
        }

        #preview-container {
            margin-top: 10px;
        }

        #preview-container img {
            max-width: 100%;
            height: auto;
        }
        
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Pengajuan Absensi</h2>

    {{-- Tampilkan pesan sukses jika ada --}}
    <div id="success-message" class="alert alert-success d-none">
        Pengajuan berhasil dikirim.
    </div>

    {{-- Tampilkan pesan error jika ada --}}
    <div id="error-message" class="alert alert-danger d-none">
        Terjadi kesalahan. Silakan coba lagi.
    </div>

    <div class="form-group mb-3">
        <label for="tanggal_izin">Tanggal Izin</label>
        <input type="date" class="form-control" id="tanggal_izin" required>
    </div>

    <div class="form-group mb-3">
        <label for="keterangan">Keterangan</label>
        <select class="form-control" id="keterangan" required>
            <option value="" selected disabled>Pilih Keterangan</option>
            <option value="sakit">Sakit</option>
            <option value="cuti">Cuti</option>
            <option value="izin">Izin</option>
            <!-- Tambahkan opsi lain sesuai kebutuhan -->
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" rows="3" placeholder="Deskripsi singkat" required></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="gambar">Upload Bukti (Opsional)</label>
        <input type="file" class="form-control-file" id="gambar" accept="image/*">
        <small class="form-text text-muted">Maksimal ukuran file: 10MB.</small>
    </div>

    <!-- Kontainer untuk preview gambar -->
    <div id="preview-container" class="text-center"></div>

    <button id="submit-btn" class="btn btn-primary btn-block">Kirim Pengajuan</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const user = JSON.parse(localStorage.getItem('user'));
        // console.log('User data:', user);

        const userId = user ? user.id : null;
        // console.log('User ID:', userId); 
        
        const gambarInput = document.getElementById('gambar');
        const previewContainer = document.getElementById('preview-container');

        // Fungsi untuk menampilkan pratinjau gambar
        gambarInput.addEventListener('change', function() {
            previewContainer.innerHTML = ''; // Kosongkan kontainer pratinjau
            const file = gambarInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('submit-btn').addEventListener('click', async function() {
            if (!userId) {
                document.getElementById('error-message').textContent = 'User ID tidak ditemukan.';
                document.getElementById('error-message').classList.remove('d-none');
                return;
            }

            const tanggalIzin = document.getElementById('tanggal_izin').value;
            const keterangan = document.getElementById('keterangan').value;
            const deskripsi = document.getElementById('deskripsi').value;

            // Membuat FormData untuk menangani file upload
            const formData = new FormData();
            formData.append('user_id', userId);
            formData.append('tanggal_izin', tanggalIzin);
            formData.append('keterangan', keterangan);
            formData.append('deskripsi', deskripsi);
            
            if (gambarInput.files.length > 0) {
                formData.append('gambar', gambarInput.files[0]);
            }

            // // Log FormData untuk debugging
            // for (const [key, value] of formData.entries()) {
            //     console.log(`${key}: ${value}`);
            // }

            try {
                const response = await fetch('{{ route('pengajuan.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                });

                if (response.ok) {
                    document.getElementById('success-message').classList.remove('d-none');
                } else {
                    document.getElementById('error-message').classList.remove('d-none');
                }
            } catch (error) {
                document.getElementById('error-message').classList.remove('d-none');
            }
        });
    });
</script>

</body>
</html>
