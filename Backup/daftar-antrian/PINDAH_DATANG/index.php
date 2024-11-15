<!doctype html>
<html lang="en" class="h-100">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Aplikasi Antrian Berbasis Web">
  <meta name="author" content="Indra Styawantoro">

  <!-- Title -->
  <title>Aplikasi Antrian Berbasis Web</title>

  <!-- Favicon icon -->
  <link rel="shortcut icon" href="../../../assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

  <!-- Custom Style -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../css/index.css">
  <style>
      /* Additional styles for very small devices */
        @media (max-width: 480px) {
            .header {
                flex-direction: column; /* Stack elements vertically */
                align-items: center; /* Center align all items */
            }
        
            .logo img {
                height: 80px; /* Further reduce logo size on very small devices */
                margin-bottom: 10px; /* Add spacing below the logo */
            }
        
            .info {
                text-align: center; /* Center-align the text */
            }
        
            .info h1 {
                font-size: 1.8em; /* Further reduce font size */
            }
        
            .info p {
                font-size: 1em; /* Further reduce paragraph font size */
                margin-bottom: 5px; /* Adjust spacing */
            }
        
            .date {
                font-size: 0.9em; /* Further reduce date font size */
                display: block; /* Ensure it appears on a new line */
                margin-top: 10px; /* Add spacing above the date */
            }
        }
  </style>
</head>

<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <div class="container pt-5">
      <div class="row justify-content-lg-center">
        <div class="mb-4">
          <div class="header">
              <div class="logo">
                  <img src="../../assets/img/LogoCompany.png" alt="Logo Kelurahan">
              </div>
              <div class="info">
                  <h1>KELURAHAN JEMURWONOSARI</h1>
                  <p>Jl. Jemursari VIII No. 49, Wonocolo, <br>Surabaya, Jawa Timur 60237</p>
              </div>
              <div class="date">
              <h2><span id="current-time"></span></h2>
              </div>
          </div>
          <div class="px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
            <!-- judul halaman -->
            <div class="d-flex align-items-center me-md-auto">
              <i class="bi-people-fill text-success me-3 fs-3"></i>
              <h1 class="h5 pt-2">Daftar Antrian</h1>
            </div>
            <!-- breadcrumbs -->
            <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
              <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../"><i class="bi-house-fill text-success"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page">Antrian</li>
                  <li class="breadcrumb-item" aria-current="page"><a href="../index.php" style="text-decoration: none; color: #00aa9d">Daftar Antrian</a></li>
                  <li class="breadcrumb-item" aria-current="page">PINDAH DATANG</li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row text-white justify-content-center mt-5 mr-5">
            <!-- Card 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a class="text-white" href="./pindah-datang-dalam-kota/index.php" style="text-decoration: none;">
                    <div class="card bg-info h-100 d-flex flex-column">
                        <div class="card-body flex-grow-1">
                            <div class="card-body-icon">
                                <i class="bi bi-tags mr-2" style="opacity: 0.4;"></i>
                            </div>
                            <h5 class="card-title">Jenis Layanan</h5>
                            <div class="display-6 font-weight-bold">PINDAH DATANG<br>DALAM KOTA</div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a class="text-white" href="./pindah-masuk-antar-kota/index.php" style="text-decoration: none;">
                    <div class="card bg-info h-100 d-flex flex-column">
                        <div class="card-body flex-grow-1">
                            <div class="card-body-icon">
                                <i class="bi bi-tags mr-2" style="opacity: 0.4;"></i>
                            </div>
                            <h5 class="card-title">Jenis Layanan</h5>
                            <div class="display-6 font-weight-bold">PINDAH MASUK<br>ANTAR KOTA / KABUPATEN</div>
                        </div>
                    </div>
                </a>
            </div>
          </div>
          <div class="row text-white justify-content-center mt-5 mr-5">
            <!-- Card 3 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a class="text-white" href="./pindah-keluar-antar-kota/index.php" style="text-decoration: none;">
                    <div class="card bg-info h-100 d-flex flex-column">
                        <div class="card-body flex-grow-1">
                            <div class="card-body-icon">
                                <i class="bi bi-tags mr-2" style="opacity: 0.4;"></i>
                            </div>
                            <h5 class="card-title">Jenis Layanan</h5>
                            <div class="display-6 font-weight-bold">PINDAH KELUAR<br>ANTAR KOTA / KABUPATEN</div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 4 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a class="text-white" href="./penduduk-nonpermanen/index.php" style="text-decoration: none;">
                    <div class="card bg-info h-100 d-flex flex-column">
                        <div class="card-body flex-grow-1">
                            <div class="card-body-icon">
                                <i class="bi bi-tags mr-2" style="opacity: 0.4;"></i>
                            </div>
                            <h5 class="card-title">Jenis Layanan</h5>
                            <div class="display-6 font-weight-bold">PENDUDUK<br>NON PERMANEN</div>
                        </div>
                    </div>
                </a>
            </div>
          </div>
          <div class="row text-white justify-content-center mt-5 mr-5">
            <!-- Card 5 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a class="text-white" href="./skpti-orang-terlantar/index.php" style="text-decoration: none;">
                    <div class="card bg-info h-100 d-flex flex-column">
                        <div class="card-body flex-grow-1">
                            <div class="card-body-icon">
                                <i class="bi bi-tags mr-2" style="opacity: 0.4;"></i>
                            </div>
                            <h5 class="card-title">Jenis Layanan</h5>
                            <div class="display-6 font-weight-bold">SKPTI ORANG<br>TERLANTAR</div>
                        </div>
                    </div>
                </a>
            </div>
          </div>

          
          

          
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer mt-auto py-4">
    <div class="container">
      <!-- copyright -->
      <div class="copyright text-center mb-2 mb-md-0">
        &copy; 2024 - <a href="" target="_blank" class="text-danger text-decoration-none">www.kelurahanjemursari.com</a>. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- jQuery Core -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // tampilkan jumlah antrian
      $('#antrian').load('get_antrian.php');

      // proses insert data
      $('#insert').on('click', function() {
        $.ajax({
          type: 'POST',                     // mengirim data dengan method POST
          url: 'insert.php',                // url file proses insert data
          success: function(result) {       // ketika proses insert data selesai
            // jika berhasil
            if (result === 'Sukses') {
              // tampilkan jumlah antrian
              $('#antrian').load('get_antrian.php').fadeIn('slow');
            }
          },
        });
      });
    });

    function updateCurrentTime() {
        var currentTime = new Date();
        var formattedTime = currentTime.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('current-time').textContent = formattedTime;
    }

    setInterval(updateCurrentTime, 1000);
    updateCurrentTime();
  </script>
</body>

</html>