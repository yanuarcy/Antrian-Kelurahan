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
  <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

  <!-- Custom Style -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <div class="container pt-5">
      <div class="row justify-content-lg-center">
        <div class="col-lg-5 mb-4">
          <div class="px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
            <!-- judul halaman -->
            <div class="d-flex align-items-center me-md-auto">
              <i class="bi-people-fill text-success me-3 fs-3"></i>
              <h1 class="h5 pt-2">Daftar Antrian</h1>
            </div>
          </div>
          

          <div class="card border-0 shadow-sm">
            <div class="card-body text-center d-grid p-5">
              <div class="border border-success rounded-2 py-2 mb-5">
                <h3 class="pt-4">ANTRIAN</h3>
                <!-- menampilkan informasi jumlah antrian -->
                <h1 id="antrian" class="display-1 fw-bold text-success text-center lh-1 pb-2"></h1>
                <h3 id="keterangan" class="pt-4"></h3>
              </div>
              <!-- button pengambilan nomor antrian -->
              <a id="insert" href="./index.php" class="btn btn-success btn-block rounded-pill fs-5 px-5 py-4 mb-2">
                <i class="bi bi-arrow-left fs-4 me-2"></i> Kembali
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
      // $('#antrian').load('./get_antrian.php');

      // Menggunakan load untuk memuat data dari get_antrian.php
      $('#antrian').load('./get_antrian.php', function(response) {
          // Memparsing JSON dari response
          var data = JSON.parse(response);
          
          // Memperbarui konten HTML dengan data dari PHP
          $('#antrian').text(data.no_antrian);
          $('#keterangan').text(data.keterangan);
      });

      // proses insert data
      // $('#insert').on('click', function() {
      //   $.ajax({
      //     type: 'POST',                     // mengirim data dengan method POST
      //     url: '../../../insert.php',                // url file proses insert data
      //     success: function(result) {       // ketika proses insert data selesai
      //       // jika berhasil
      //       if (result === 'Sukses') {
      //         // tampilkan jumlah antrian
      //         $('#antrian').load('../../../get_antrian.php').fadeIn('slow');
      //       }
      //     },
      //   });
      // });
    });
  </script>
</body>

</html>