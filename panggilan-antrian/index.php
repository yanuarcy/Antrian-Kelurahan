<?php 
  include '../middleware/auth.php';
  
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
  <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

  <!-- Custom Style -->
  <link rel="stylesheet" href="../assets/css/style.css">
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

    .status-button {
        background-color: transparent;
        color: #00aa9d;
        border: 2px solid #00aa9d;
        border-radius: 5px;
        padding: 8px 16px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-right: 10px;
    }

    .status-button.active {
        background-color: #00aa9d;
        color: white;
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
    <div class="container pt-4">
      <div class="header">
        <div class="logo">
            <img src="../assets/img/LogoCompany.png" alt="Logo Kelurahan">
        </div>
        <div class="info">
            <h1>KELURAHAN JEMURWONOSARI</h1>
            <p>Jl. Jemursari VIII No. 49, Wonocolo, <br>Surabaya, Jawa Timur 60237</p>
        </div>
        <div class="date">
        <h2><span id="current-time"></span></h2>
        </div>
      </div>
      <div class="d-flex flex-column flex-md-row px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
        <!-- judul halaman -->
        <div class="d-flex align-items-center me-md-auto">
          <i class="bi-mic-fill text-success me-3 fs-3"></i>
          <h1 class="h5 pt-2">Front Office Loket <?php echo $_SESSION['Loket'] ?></h1>
        </div>
        <!-- breadcrumbs -->
        <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../"><i class="bi-house-fill text-success"></i></a></li>
              <li class="breadcrumb-item" aria-current="page">Front Office</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class='alert alert-info'>
        <h4 class="alert-heading">Selamat Datang di Dashboard Front Office SILOK!</h4>
        <p><strong>Halo, <?php echo $_SESSION['nama']; ?>!</strong></p>
        <p>Anda telah masuk ke Sistem Informasi Layanan Online Kependudukan. Di sini Anda dapat:</p>
        <ul>
          <li>Memantau data pemohon secara real-time</li>
          <li>Mengelola dan memanggil nomor antrian pemohon</li>
          <li>Memastikan kelancaran proses pelayanan kependudukan</li>
        </ul>
        <hr>
        <p class="mb-0">Ingat, efisiensi dan keramahan adalah kunci pelayanan prima. Semoga hari Anda produktif!</p>
      </div>
      <div class="row">
        <!-- menampilkan informasi jumlah antrian -->
        <div class="col-md-3 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex justify-content-start">
                <div class="feature-icon-3 me-4">
                  <i class="bi-people text-warning"></i>
                </div>
                <div>
                  <p id="jumlah-antrian" class="fs-3 text-warning mb-1"></p>
                  <p class="mb-0">Jumlah Antrian</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- menampilkan informasi nomor antrian yang sedang dipanggil -->
        <div class="col-md-3 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex justify-content-start">
                <div class="feature-icon-3 me-4">
                  <i class="bi-person-check text-success"></i>
                </div>
                <div>
                  <p id="antrian-sekarang" class="fs-3 text-success mb-1"></p>
                  <p class="mb-0">Antrian Sekarang</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- menampilkan informasi nomor antrian yang akan dipanggil selanjutnya -->
        <div class="col-md-3 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex justify-content-start">
                <div class="feature-icon-3 me-4">
                  <i class="bi-person-plus text-info"></i>
                </div>
                <div>
                  <p id="antrian-selanjutnya" class="fs-3 text-info mb-1"></p>
                  <p class="mb-0">Antrian Selanjutnya</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- menampilkan informasi jumlah antrian yang belum dipanggil -->
        <div class="col-md-3 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex justify-content-start">
                <div class="feature-icon-3 me-4">
                  <i class="bi-person text-danger"></i>
                </div>
                <div>
                  <p id="sisa-antrian" class="fs-3 text-danger mb-1"></p>
                  <p class="mb-0">Sisa Antrian</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="btn-group mb-3" role="group" aria-label="Status Filter">
              <button id="btn-offline" type="button" class="status-button active">Offline</button>
              <button id="btn-online" type="button" class="status-button">Online</button>
          </div>
          <h6 id="text-information1" style="color: red;">*Pencet tombol "End Call" ketika pemohon sudah selesai dihubungi via call.</h6>
          <h6 id="text-information2" style="color: red;">**Pencet tombol "Kirim Pesan" ketika proses layanan sudah selesai.</h6>
          <div class="table-responsive">
            <table id="tabel-antrian" class="table table-bordered table-striped table-hover" width="100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama</th>
                  <th>Nomer Whatsapp</th>
                  <th>Alamat</th>
                  <th>Jenis Layanan</th>
                  <th>Keterangan</th>
                  <th>Nomor Antrian</th>
                  <th>Status</th>
                  <th>Jenis Pengiriman</th>
                  <th>Calling By</th>
                  <th>Aksi</th>
                  <th>Panggil</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer mt-auto py-4">
    <div class="container">
      <hr class="my-4">
      <!-- copyright -->
      <div class="copyright text-center mb-2 mb-md-0">
        &copy; 2024 - <a href="" target="_blank" class="text-danger text-decoration-none">www.kelurahanjemursari.com</a>. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- load file audio bell antrian -->
  <audio id="tingtung" src="../assets/audio/tingtung.mp3"></audio>

  <!-- jQuery Core -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <!-- DataTables -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <!-- Responsivevoice -->
  <!-- Get API Key -> https://responsivevoice.org/ -->
  <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>

  <script type="text/javascript">
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


    $(document).ready(function() {
      // tampilkan informasi antrian
      $('#jumlah-antrian').load('get_jumlah_antrian.php');
      $('#antrian-sekarang').load('get_antrian_sekarang.php');
      // $('#antrian-selanjutnya').load('get_antrian_selanjutnya.php');
      $('#antrian-selanjutnya').load('get_antrian_selanjutnya.php', function(response) {
        // Ambil elemen pertama dari response JSON dan tampilkan tanpa tanda kurung atau kutip
        var nextQueue = JSON.parse(response)[0];
        $('#antrian-selanjutnya').text(nextQueue);
      });
      $('#sisa-antrian').load('get_sisa_antrian.php');
      
      // Function to mask the WhatsApp number
      function maskWhatsapp(number) {
        // Mask the number, keeping the first four digits visible
        return number.replace(/(\d{4})(\d{4})/, '$1********');
      }

      // Function to unmask the WhatsApp number
      function unmaskWhatsapp(number) {
        // Unmask the number (this function could be extended as needed)
        return number; // Assuming you have the full number available already
      }

      // Default to Offline when the page loads
      var jenis_antrian = "Offline";
      $('#text-information1').hide();
      $('#text-information2').hide();

      // Function to reload the table with the appropriate filter
      function reloadTable() {
          table.ajax.reload();
      }
      var loket = "<?php echo $_SESSION['Loket']; ?>";

      // Initialize the table with default filter (e.g., Offline)
      var table = $('#tabel-antrian').DataTable({
          "lengthChange": false,
          "searching": false,
          "ajax": {
              "url": "get_antrian.php",
              "data": function (d) {
                  d.jenis_antrian = jenis_antrian; // Default to Offline
              }
          },
          "columns": [
              {"data": "id", "visible": false},
              {"data": "nama", "width": '250px', "className": 'text-center'},
              {
                "data": "no_whatsapp",
                "width": '250px',
                "className": 'text-center',
                "render": function (data, type, row) {
                  var loketNumber = row['calling_by'].match(/\d+/); // Extract the number from 'Loket X'
                  
                  if (data === '-') {
                    return "No Device";
                  }

                  if (jenis_antrian === "Online"){
                    // Check if calling_by is empty or matches the current loket
                    if (loketNumber && loketNumber[0] === loket) {
                      return data; // Display the full number when calling_by matches the current loket or is empty
                    } else if (row['calling_by'] === ""){
                      return maskWhatsapp(data); // Display masked number otherwise
                    } else {
                      return maskWhatsapp(data); // Display masked number otherwise
                    }
                  } else {
                    return data;
                  }
                }
              },
              {"data": "alamat", "width": '250px', "className": 'text-center'},
              {"data": "jenis_layanan", "width": '250px', "className": 'text-center'},
              {"data": "keterangan", "width": '250px', "className": 'text-center'},
              {"data": "no_antrian", "width": '250px', "className": 'text-center'},
              {"data": "status", "visible": false},
              {"data": "jenis_pengiriman", "width": '250px', "className": 'text-center', "visible": false}, // New column, hidden by default
              {"data": "calling_by", "width": '250px', "className": 'text-center', "visible": false}, // New column, hidden by default
              {
                "data": null,
                "orderable": false,
                "searchable": false,
                "width": '150px',
                "className": 'text-center',
                "render": function (data, type, row) {
                  var btnStatus;
                  var loketNumber = data['calling_by'].match(/\d+/); // Extract the number from 'Loket X'

                  // Check if calling_by is empty or matches the current loket
                  if (data['status'] === "") {
                      btnStatus = "-";
                  } else if (data['calling_by'] === "" || (loketNumber && loketNumber[0] === loket)) {
                    // Button is enabled when calling_by is empty or matches the active loket
                    var buttonText = data['calling_by'] === "" ? "Call" : "End Call";
                    var buttonClass = data['calling_by'] === "" ? 'btn-success' : 'btn-danger';
                    btnStatus = `<button class='btn ${buttonClass} btn-sm toggle-call'>${buttonText}</button>`;
                  } else {
                    // Button is disabled if calling_by does not match the active loket
                    btnStatus = "<button class='btn btn-success btn-sm toggle-call' disabled>On Call</button>";
                  }
                  return btnStatus;
                },
                "visible": false // Hidden by default
              },
              {
                  "data": null,
                  "orderable": false,
                  "searchable": false,
                  "width": '100px',
                  "className": 'text-center',
                  "render": function(data, type, row) {
                      var btn;
                      if (data["status"] === "") {
                          btn = "-";
                      } else if (jenis_antrian === "Online") {
                        if (data['status'] === "0") {
                          btn = "<button class=\"btn btn-primary btn-sm panggil\">Kirim Pesan</button>";
                        } else if (data['status'] === "1") {
                          btn = "<button class=\"btn btn-secondary btn-sm panggil\">Terlayani</button>";
                        }
                      } else if (data["status"] === "0") {
                          btn = "<button class=\"btn btn-success btn-sm rounded-circle panggil\"><i class=\"bi-mic-fill\"></i></button>";
                      } else if (data["status"] === "1") {
                          btn = "<button class=\"btn btn-secondary btn-sm rounded-circle panggil\"><i class=\"bi-mic-fill\"></i></button>";
                      }
                      return btn;
                  }
              }
              
          ],
          "order": [[0, "desc"]],
          "iDisplayLength": 10
      });

      // Button click events to update the jenis_antrian and reload the table
      $('#btn-offline').on('click', function() {
          jenis_antrian = "Offline";
          table.column(8).visible(false);
          table.column(9).visible(false); // Hide "Calling By" column
          table.column(10).visible(false); // Hide "Aksi" column
          $('#text-information1').hide();
          $('#text-information2').hide();
          reloadTable();
          $('#btn-offline').addClass('active');
          $('#btn-online').removeClass('active');
      });

      $('#btn-online').on('click', function() {
          jenis_antrian = "Online";
          table.column(8).visible(true);
          table.column(9).visible(true); // Show "Calling By" column
          table.column(10).visible(true); // Show "Aksi" column
          $('#text-information1').show();
          $('#text-information2').show();
          reloadTable();
          $('#btn-online').addClass('active');
          $('#btn-offline').removeClass('active');
      });
      
      // Toggle "Call" and "End Call" button functionality
      $('#tabel-antrian').on('click', '.toggle-call', function () {
        var $btn = $(this);
        var rowData = table.row($(this).parents('tr')).data();
        
        if ($btn.text() === 'Call') {
          // Update the queue status when 'Call' is clicked
          $.ajax({
            type: "POST",
            url: "updateCallingBy.php",
            data: {
              id: rowData["id"],
              loket: loket // Send loket value along with other data
            },
            success: function (response) {
              // Unmask the WhatsApp number in the row
              // $row.find('td').eq(1).text(rowData["no_whatsapp"]);

              // Update the button to 'End Call'
              $btn.text('End Call').removeClass('btn-primary').addClass('btn-danger');
              reloadTable();
            }
          });
        } else if ($btn.text() === 'End Call') {
          var loketNumber = rowData['calling_by'].match(/\d+/);

          // Check if the active loket matches the loket in calling_by
          if (loketNumber && loketNumber[0] === loket) {
            // Reset calling_by when 'End Call' is clicked
            $.ajax({
              type: "POST",
              url: "updateCallingBy.php",
              data: {
                id: rowData["id"],
                loket: "", // Send an empty value to clear the calling_by column
                reset_calling_by: true // Add a flag to differentiate this action on the server side
              },
              success: function (response) {
                // Mask the WhatsApp number again
                // $row.find('td').eq(1).text(maskWhatsapp(rowData["no_whatsapp"]));

                // Update the button back to 'Call'
                $btn.text('Call').removeClass('btn-danger').addClass('btn-primary');
                reloadTable();
              }
            });
          }
        }
      });
      
      // Fungsi addToQueue yang diperbarui
      async function addToQueue(antrian, loket, nama = null, whatsapp = null) {
        try {
            const data = {
                antrian: antrian,
                loket: loket,
                nama: nama || '',
                whatsapp: whatsapp || ''
            };

            console.log('Sending data:', data);  // Log data yang dikirim

            const response = await fetch('../api/api.php?action=add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            console.log('Response status:', response.status);  // Log status response

            const responseText = await response.text();
            console.log('Raw response:', responseText);  // Log raw response

            try {
                const result = JSON.parse(responseText);
                console.log('Parsed response:', result);
                return result;
            } catch (parseError) {
                console.error('Error parsing JSON:', parseError);
                throw new Error('Invalid JSON response: ' + responseText);
            }
        } catch (error) {
            console.error('Error in addToQueue:', error);
            throw error;
        }
      }

      // panggilan antrian dan update data
      $('#tabel-antrian tbody').on('click', '.panggil', async function() {
          try {
            // ambil data dari datatables 
            var data = table.row($(this).parents('tr')).data();
            // buat variabel untuk menampilkan data "id"
            var id = data["id"];
            var antrian = data["no_antrian"];
            var nama = data["nama"];
            var loket = "<?php echo $_SESSION['Loket'] ?>";
            var whatsapp = data["no_whatsapp"];
            var namaPetugas = "<?php echo $_SESSION['nama'] ?>"; // Ambil nama petugas dari session
    
            if ($(this).text() === "Kirim Pesan") {
              var whatsapp = data["no_whatsapp"];
              var nama = data["nama"];
              var jenis_layanan = data["jenis_layanan"];
              var keterangan = data["keterangan"];
              var jenis_pengiriman = data["jenis_pengiriman"];
              var nomor_terbaru = antrian;
    
              $.ajax({
                  type: "POST",
                  url: "send_whatsapp.php",  // New PHP file for sending WhatsApp messages
                  data: {
                      whatsapp: whatsapp,
                      nama: nama,
                      jenis_layanan: jenis_layanan,
                      keterangan: keterangan,
                      jenis_pengiriman: jenis_pengiriman,
                      nomor_terbaru: nomor_terbaru
                  },
                  success: function(response) {
                    //   alert("Pesan WhatsApp berhasil dikirim.");
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Pesan WhatsApp berhasil dikirim.",
                      showConfirmButton: false,
                      timer: 1500
                    });
                  },
                  error: function() {
                      alert("Gagal mengirim pesan WhatsApp.");
                  }
              });
    
              // $.post('trigger_audio.php', { antrian: antrian, loket: loket });
            
    
              var loket = "<?php echo $_SESSION['Loket']; ?>";
    
              // proses update data
              $.ajax({
                type: "POST",               // mengirim data dengan method POST
                url: "update.php",          // url file proses update data
                data: { 
                  id: id,
                  loket: loket // Kirim nilai loket bersama dengan data lainnya
                }            // tentukan data yang dikirim
              });
    
              // Update the queue status as before
              $.ajax({
                  type: "POST",
                  url: "update.php",
                  data: { 
                    id: data["id"],
                    loket: loket // Kirim nilai loket bersama dengan data lainnya
                  }
              });
            } else {
              
              const queueResult = await addToQueue(antrian, loket, nama, whatsapp);
              console.log('Queue result:', queueResult);  // Log hasil
    
              if (queueResult.status !== 'success') {
                  throw new Error(queueResult.message || 'Gagal menambahkan ke antrian');
              }
            
                // if (whatsapp === "No Device" || whatsapp === "-") {
                //     $.post('trigger_audio.php', { antrian: antrian, nama: nama, loket: loket });
                // } else {
                //     $.post('trigger_audio.php', { antrian: antrian, loket: loket });
                // }
            
    
              var loket = "<?php echo $_SESSION['Loket']; ?>";
    
              // proses update data
              $.ajax({
                type: "POST",               // mengirim data dengan method POST
                url: "update.php",          // url file proses update data
                data: { 
                  id: id,
                  loket: loket, // Kirim nilai loket bersama dengan data lainnya
                  namaPetugas: namaPetugas // Kirim nama petugas
                }            // tentukan data yang dikirim
              });
    
              // Update the queue status as before
            //   $.ajax({
            //       type: "POST",
            //       url: "update.php",
            //       data: { 
            //         id: data["id"],
            //         loket: loket // Kirim nilai loket bersama dengan data lainnya
            //       }
            //   });
            }
          } catch (error) {
          console.error('Error in queue handling:', error);
        }
        
      });

      // auto reload data antrian setiap 1 detik untuk menampilkan data secara realtime
      setInterval(function() {
        $('#jumlah-antrian').load('get_jumlah_antrian.php').fadeIn("slow");
        $('#antrian-sekarang').load('get_antrian_sekarang.php').fadeIn("slow");
        // $('#antrian-selanjutnya').load('get_antrian_selanjutnya.php').fadeIn("slow");
        $('#antrian-selanjutnya').load('get_antrian_selanjutnya.php', function(response) {
          // Ambil elemen pertama dari response JSON dan tampilkan tanpa tanda kurung atau kutip
          var nextQueue = JSON.parse(response)[0];
          $('#antrian-selanjutnya').text(nextQueue);
        }).fadeIn("slow");
        $('#sisa-antrian').load('get_sisa_antrian.php').fadeIn("slow");
        table.ajax.reload(null, false);
      }, 1000);
    });

    // Get the buttons
    const btnOffline = document.getElementById('btn-offline');
    const btnOnline = document.getElementById('btn-online');

    // Function to toggle active class
    function toggleActiveButton(clickedButton, otherButton) {
        clickedButton.classList.add('active');
        otherButton.classList.remove('active');
    }

    // Add event listeners
    btnOffline.addEventListener('click', function() {
        toggleActiveButton(btnOffline, btnOnline);
        // Your logic to display Offline data can go here
    });

    btnOnline.addEventListener('click', function() {
        toggleActiveButton(btnOnline, btnOffline);
        // Your logic to display Online data can go here
    });
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>