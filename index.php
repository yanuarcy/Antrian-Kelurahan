<?php

session_start()

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Aplikasi Antrian Berbasis Web">
  <meta name="author" content="Yanuar Cahyo E.W">

  <!-- Title -->
  <title>Antrian Kelurahan Jemurwonosari</title>

  <!-- Favicon icon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

  <!-- Custom Style -->
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    .header {
    width: 100%;
    background: #00aa9d;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    box-sizing: border-box;
    color: #ffffff;
    
    }

    .logo img {
        height: 170px;
    }

    .info {
        flex-grow: 1;
        margin-left: 20px;
    }

    .info h1 {
        margin: 0;
        font-size: 3.5em;
        font-family: Poppins-Regular;
    }

    .info p {
        margin: 5px 0 0;
        font-size: 1.5em;
        font-family: Poppins-Regular;
    }

    .date {
        font-size: 1.2em;
    }
    
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
      <div class="header">
          <div class="logo">
              <img src="./assets/img/LogoCompany.png" alt="Logo Kelurahan">
          </div>
          <div class="info">
              <h1>KELURAHAN<br>JEMURWONOSARI</h1>
              <p>Jl. Jemursari VIII No. 49, Wonocolo, <br>Surabaya, Jawa Timur 60237</p>
          </div>
          <div class="date">
          <h2><span id="current-time"></span></h2>
          </div>
      </div>
      <!-- tampilkan pesan selamat datang -->
      <div class="alert alert-light d-flex justify-content-between align-items-center mb-2" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi-info-circle text-success me-3 fs-3"></i>
            <div>
                Selamat Datang di <strong>SILOK</strong> (Sistem Informasi Layanan Online Kelurahan). 
                <ul class="mt-2">
                    <li>Pilih layanan yang Anda butuhkan</li>
                    <li>Pantau status permohonan Anda</li>
                    <li>Lihat informasi terbaru dari kelurahan</li>
                </ul>
            </div>
        </div>
        <?php 
          if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
              echo '<a href="controllers/logout.php" class="btn btn-danger rounded-pill px-4 py-2">
            Logout <i class="bi bi-box-arrow-right ms-2"></i>
        </a>';
          } else {
              echo '<a href="login" class="btn btn-success rounded-pill px-4 py-2">
            Login <i class="bi bi-box-arrow-in-right ms-2"></i>
        </a>';
          }
        ?>
      </div>

      <div class="row gx-5">
        <!-- link halaman nomor antrian -->
        <div class="col-lg-6 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
              <div class="feature-icon-1 bg-success bg-gradient mb-4">
                <i class="bi-people"></i>
              </div>
              <h3>Daftar Antrian</h3>
              <p class="mb-4">Halaman Daftar Antrian digunakan pemohon untuk mengambil nomor antrian.</p>
              <a href="daftar-antrian" class="btn btn-success rounded-pill px-4 py-2">
                Tampilkan <i class="bi-chevron-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- link halaman panggilan antrian -->
        <div class="col-lg-6 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
              <div class="feature-icon-1 bg-success bg-gradient mb-4">
                <i class="bi-mic"></i>
              </div>
              <h3>Front Office</h3>
              <p class="mb-4">Halaman Front Office merupakan sebuah Dashboard yang digunakan petugas loket untuk memanggil antrian pemohon.</p>
              <?php 
              if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                echo '<a href="panggilan-antrian" class="btn btn-success rounded-pill px-4 py-2">
                Tampilkan <i class="bi-chevron-right ms-2"></i>
              </a>';
              } else {
                echo '<a href="javascript:InformToLogin()" class="btn btn-success rounded-pill px-4 py-2">
                Tampilkan <i class="bi-chevron-right ms-2"></i>
              </a>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row gx-5">
        <!-- link halaman nomor antrian -->
        <div class="col-lg-6 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
              <div class="feature-icon-1 bg-success bg-gradient mb-4">
                <i class="bi bi-tv"></i>
              </div>
              <h3>Display Antrian</h3>
              <p class="mb-4">Halaman Display Antrian digunakan pemohon untuk melihat nomor urutan antrian.</p>
              <a href="Layout" class="btn btn-success rounded-pill px-4 py-2">
                Tampilkan <i class="bi-chevron-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
              <div class="feature-icon-1 bg-success bg-gradient mb-4">
                <i class="bi bi-speedometer2"></i>
              </div>
              <h3>Dashboard</h3>
              <p class="mb-4">Halaman Dashboard digunakan untuk melihat dan memproses semua data website yang hanya bisa di akses oleh Admin saja.</p>
              <?php 
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                  if(isset($_SESSION['level'])){
                    if ($_SESSION['level'] == 'Admin') { 
                      echo '<a href="admin/Dashboard.php" class="btn btn-success rounded-pill px-4 py-2">
                        Tampilkan <i class="bi-chevron-right ms-2"></i>
                      </a>';
                    } else {
                      echo '<a href="javascript:InformToLoginAdmin()" class="btn btn-success rounded-pill px-4 py-2">
                        Tampilkan <i class="bi-chevron-right ms-2"></i>
                      </a>';
                    }
                  };
                } else {
                  echo '<a href="javascript:InformToLogin()" class="btn btn-success rounded-pill px-4 py-2">
                    Tampilkan <i class="bi-chevron-right ms-2"></i>
                  </a>';
                }
              ?>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer mt-auto py-4">
    <div class="container-fluid">
      <!-- copyright -->
      <div class="copyright text-center mb-2 mb-md-0">
        &copy; 2024 - <a href="" target="_blank" class="text-danger text-decoration-none">www.kelurahanjemursari.com</a>. All rights reserved.
      </div>
    </div>
  </footer>

  <script type="text/javascript">
      function InformToLogin(){
        // alert('Anda harus Login terlebih dahulu agar bisa masuk ke halaman tersebut, Terimakasih !');
        // window.location = "../login";
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Anda harus login terlebih dahulu!",
        });
      }

      function InformToLoginAdmin(){
        // alert('Anda harus Login sebagai Admin terlebih dahulu agar bisa masuk ke halaman tersebut, Terimakasih !');
        // window.location = "../";
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Hanya Admin yang bisa mengakses Dashboard!",
        });
      }

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

  <!-- Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>