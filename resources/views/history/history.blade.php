<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Absensi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css')}}">
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@6.0.0/dist/ionicons/ionicons.esm.js"></script>
    
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="cloud">
          <path d="M31.714,25.543c3.335-2.17,4.27-6.612,2.084-9.922c-1.247-1.884-3.31-3.077-5.575-3.223h-0.021
          C27.148,6.68,21.624,2.89,15.862,3.931c-3.308,0.597-6.134,2.715-7.618,5.708c-4.763,0.2-8.46,4.194-8.257,8.919
          c0.202,4.726,4.227,8.392,8.991,8.192h4.873h13.934C27.784,26.751,30.252,26.54,31.714,25.543z" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="lens">
          <path d="M15.656,13.692l-3.257-3.229c2.087-3.079,1.261-7.252-1.845-9.321c-3.106-2.068-7.315-1.25-9.402,1.83
          s-1.261,7.252,1.845,9.32c1.123,0.748,2.446,1.146,3.799,1.142c1.273-0.016,2.515-0.39,3.583-1.076l3.257,3.229
          c0.531,0.541,1.404,0.553,1.95,0.025c0.009-0.008,0.018-0.017,0.026-0.025C16.112,15.059,16.131,14.242,15.656,13.692z M2.845,6.631
          c0.023-2.188,1.832-3.942,4.039-3.918c2.206,0.024,3.976,1.816,3.951,4.004c-0.023,2.171-1.805,3.918-3.995,3.918
          C4.622,10.623,2.833,8.831,2.845,6.631L2.845,6.631z" />
        </symbol>
      </svg>  
          
      
     

<div class="container">
    <div class="header">
        <span class="back-button">
            <a href="/dashboard"><ion-icon name="arrow-back-outline"></ion-icon></a>
        </span>
        <h1>History Absensi</h1>
        <div class="search" >
            <input type="text" placeholder="search"  id="searchInput"/>
            <div class="symbol">
              <svg class="cloud">
                <use xlink:href="#cloud" />
              </svg>
              <svg class="lens">
                <use xlink:href="#lens" />
              </svg>
            </div>
          </div>
        <span></span>
        
            <!-- Empty space for alignment -->
    </div>
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="absensiTable">
                <thead class="thead-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan diisi melalui JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Ambil ID user dari localStorage
    const user = JSON.parse(localStorage.getItem('user'));
    const userId = user ? user.id : null;

    if (userId) {
        fetch(`/api/absensi/${userId}`)
            .then(response => response.json())
            .then(data => {
                
                const tableBody = document.querySelector('#absensiTable tbody');
                tableBody.innerHTML = '';

                data.forEach(absensi => {
                    const row = document.createElement('tr');

                    const tanggalCell = document.createElement('td');
                    tanggalCell.textContent = new Date(absensi.created_at).toLocaleDateString();
                    row.appendChild(tanggalCell);

                    const jamMasukCell = document.createElement('td');
                    jamMasukCell.textContent = new Date(absensi.jam_masuk).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) || '-';
                    row.appendChild(jamMasukCell);

                    const jamPulangCell = document.createElement('td');
                    jamPulangCell.textContent = absensi.jam_pulang ? new Date(absensi.jam_pulang).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : '-';
                    row.appendChild(jamPulangCell);

                    const statusCell = document.createElement('td');
                    if (absensi.jam_pulang) {
                        statusCell.textContent = 'Hadir';
                        statusCell.classList.add('status-hadir');
                    } else {
                        statusCell.textContent = 'In Progress';
                        statusCell.classList.add('in-Progress');
                    }
                    row.appendChild(statusCell);

                    tableBody.appendChild(row);
                });

                // Tambahkan Event Listener untuk Search Input
                const searchInput = document.getElementById('searchInput');
                searchInput.addEventListener('keyup', function() {
                    const filter = searchInput.value.toLowerCase();
                    const rows = tableBody.getElementsByTagName('tr');
                    for (let i = 0; i < rows.length; i++) {
                        const cells = rows[i].getElementsByTagName('td');
                        let match = false;
                        for (let j = 0; j < cells.length; j++) {
                            if (cells[j].textContent.toLowerCase().includes(filter)) {
                                match = true;
                                break;
                            }
                        }
                        rows[i].style.display = match ? '' : 'none';
                    }
                });
            })
            .catch(error => console.error('Error fetching absensi data:', error));
    } else {
        console.error('User ID not found in localStorage');
    }
});

</script>

</body>
</html>
