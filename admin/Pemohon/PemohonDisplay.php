<?php 
    include "../../config/PemohonConfig.php";
    include '../../middleware/auth.php';
    // include "../../controllers/login_process.php";
    $lib = new PemohonConfig();
    $data_pemohon = $lib->show();

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $status_hapus = $lib->delete($id);
        if($status_hapus){
            header('Location: AntarmukaDisplay.php');
        }
    }

    // session_start();
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        $memberID = $_SESSION['id_loket'];
    }

    if(isset($_POST['cari'])) {
        $search = $_POST['keyword'];
        $data_search = $lib->ShowSearch($search);
    }

    if (isset($_POST['register'])) {
        $nama_video = $_POST["nama_video"];
        $keterangan = $_POST["keterangan"];
        $alamat_url = $_POST["alamat_url"];
        $addAntarmuka = new AntarmukaConfig();
        $addAntarmuka->createAntarmuka($nama_video, $keterangan, $alamat_url);
        if ($addAntarmuka) {
            header('Location: ../Antarmuka/AntarmukaDisplay.php');
        }
    }
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="css/AddAntarmuka.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    
    <title>Admin - Data Pemohon</title>

    <style>
        .Button {
            background-color: #0081B4;
            outline: none;
            border: none;
            margin: 1%;
            padding: 8px;
            border-radius: 10px;
            color: white;
        }

        .Button:hover {
            background-color: orange;
        }

        #start_date {
            padding: 5px;
            border-radius: 15px;
            border: none;
            background-color: rgb(199, 155, 74);
            color: white;
            cursor: pointer;
        }

        #end_date {
            padding: 5px;
            border-radius: 15px;
            border: none;
            background-color: rgb(199, 155, 74);
            color: white;
            cursor: pointer;
        }

        .Dateinput input:focus {
            outline: none !important;
            border-bottom: 2px solid rgb(91, 243, 131);
            font-size: 17px;
            font-weight: bold;
            color: black;
        }

    </style>


</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="#"><img src="../../assets/img/LogoCompany.png" alt="Logo Kelurahan" style="height: 50px;">SELAMAT DATANG ADMIN | Kelurahan Jemurwonosari - Antrian</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
            <form class="form-inline my-2 my-lg-0 ml-auto">

            </form>

            <div class="icon ml-4">
            <h5>
                <a href="../../" style="font-size: 25px; color: black; text-decoration: none;">Exit <i class="bi bi-box-arrow-right mr-3" data-toggle="tooltip" title="Exit"></i></a>
            </h5>
            </div>
    </nav>

        <div class="row no-gutters mt-5">
            <div class="col-md-2 bg-dark mt-2 pr-3">
                <div class="bglink">
                <ul class="nav flex-column ml-3">
                    <li class="nav-item">
                    <!-- <img src="img/profil1.jpg" class="d-inline-block align-bottom rounded-circle mr-1 ml-3  " alt=""> -->
                    <i class="bi bi-person-fill d-inline-block align-bottom rounded-circle mr-1 ml-3 " style="font-size: 24px; color: white;"></i>
                    <a class="navbar-brand" href="#"><?php echo $nama ?></a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../Dashboard.php"><i class="bi bi-speedometer2 pr-2 pl-1" style="font-size: 30px;"></i>Dashboard</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../Member/MemberDisplay.php"><i class="bi-people pr-2 pl-1" style="font-size: 27px;"></i>Data Member</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../Pelayanan/PelayananDisplay.php"><i class="bi bi-layout-text-sidebar-reverse pr-2" style="font-size: 27px;"></i>Data Pelayanan</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../Loket/LoketDisplay.php"><i class="bi bi-key pr-2" style="font-size: 27px;"></i>Data Loket</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../apiWhatsapp/DataApiDisplay.php"><i class="bi bi-link-45deg pr-2" style="font-size: 27px;"></i>Data Api Whatsapp</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../Antarmuka/AntarmukaDisplay.php"><i class="bi bi-tv pr-3" style="font-size: 27px;"></i>Data Antarmuka</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="PemohonDisplay.php"><i class="bi bi-person pr-3" style="font-size: 27px;"></i>Data Pemohon</a><hr class="bg-secondary">
                    </li>
                </ul>
                </div>
            </div>
            <div class="col-md-10 p-5 pt-2">
                <h3>DATA PEMOHON</h3><hr>
                <?php 
                    if(isset($_POST['kirim'])){
                        $start_date = $_POST["start_date"];
                        $end_date = $_POST["end_date"];
                    
                ?>
                <h3>Data Periode <?php echo $start_date ?> s/d <?php echo $end_date ?></h3>
                <?php }else {
                ?>
                <h3>Data Periode s/d </h3>
                <?php }
                ?>

                <form action="PemohonDisplay.php" class="Dateinput" method="post">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date">

                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date">

                    <input class="Button" name="kirim" type="submit" value="Tampilkan" readonly>
                </form>

                <div class="data-tables datatable-dark">
                    <table class="table table-striped table-bordered table-hover mt-3" id="ExportPdf">
                        <thead class="thead bg-info">
                            <tr>
                            <th scope="col">NO</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">NAMA</th>
                            <!--<th scope="col">EMAIL</th>-->
                            <th scope="col">NO WHATSAPP</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">JENIS LAYANAN</th>
                            <th scope="col">KETERANGAN</th>
                            <th scope="col">JENIS ANTRIAN</th>
                            <th scope="col">JENIS PENGIRIMAN</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DILAYANI OLEH</th>
                            <th scope="col">TANGGAL DILAYANI</th>
                            </tr>
                        </thead>
                        <tbody>
                        

                        <?php    
                            $no = 1;
                            if(isset($_POST['kirim'])) {
                                $start_date = $_POST["start_date"];
                                $end_date = $_POST["end_date"];
                                $data_Date = $lib->ShowWithDate($start_date, $end_date);
                                foreach($data_Date as $row){
                                    $status_button_class = $row['status'] == 1 ? 'btn-success' : 'btn-secondary';
                                    $status_text = $row['status'] == 1 ? 'Terlayani' : 'Belum Terlayani';

                                    echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                    // echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['no_whatsapp']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jenis_layanan']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jenis_antrian']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jenis_pengiriman']) . "</td>";
                                    echo "<td class='text-center'>
                                            <button class='btn $status_button_class' disabled>
                                                $status_text
                                            </button>
                                        </td>";
                                    echo "<td>" . htmlspecialchars($row['petugas']) . "</td>";
                                    echo "<td>" . htmlspecialchars(!empty($row['tanggal_dilayani']) ? $row['tanggal_dilayani'] : "NULL") . "</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                            }
                            else {
                                foreach($data_pemohon as $row){
                                    $status_button_class = $row['status'] == 1 ? 'btn-success' : 'btn-secondary';
                                    $status_text = $row['status'] == 1 ? 'Terlayani' : 'Belum Terlayani';

                                    echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                    // echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['no_whatsapp']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jenis_layanan']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jenis_antrian']) . "</td>";
                                    // echo "<td>" . htmlspecialchars($row['jenis_pengiriman']) . "</td>";
                                    echo "<td class = 'text-center'>" . (!empty($row['jenis_pengiriman']) ? htmlspecialchars($row['jenis_pengiriman']) : "-") . "</td>";
                                    echo "<td class='text-center'>
                                            <button class='btn $status_button_class' disabled>
                                                $status_text
                                            </button>
                                        </td>";
                                    echo "<td>" . htmlspecialchars($row['petugas']) . "</td>";
                                    echo "<td>" . htmlspecialchars(!empty($row['tanggal_dilayani']) ? $row['tanggal_dilayani'] : "NULL") . "</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                            }
                        ?>
                            
                        <!-- <i class="bi bi-pencil-fill"></i> -->
                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <script type="text/javascript">

        $(document).ready(function() {
            $('#ExportPdf').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape', // Set orientation to landscape
                        pageSize: 'A4', // You can also set the paper size (e.g., A3, A5, etc.)
                        exportOptions: {
                            columns: ':visible' // Export only visible columns
                        },
                        customize: function(doc) {
                            // Change the title
                            doc.content[0].text = 'Data Pemohon Antrian Kelurahan Jemurwonosari';
                            doc.content[0].style = 'title'; // Keep the same style as the original title
                            
                            // Set specific widths for "NO" and "TANGGAL" columns
                            var widths = [
                                '3%',  // NO column
                                '8%',  // TANGGAL column,
                                '10%',
                                '12%',
                                '10%',
                                '9%',
                                '9%',
                                '16%',
                                '5%',
                                '8%',
                                '8%'

                            ];

                            // Set the remaining columns to auto width
                            var otherWidths = Array(doc.content[1].table.body[0].length - widths.length).fill('*');
                            
                            // Combine the widths
                            doc.content[1].table.widths = widths.concat(otherWidths);
                        }
                    },
                    'print'
                ]
            } );
        } );

        $(document).ready(function() {
            console.log("Document is ready");

            // Event handler for the activate-video button
            $('.activate-video').on('click', function() {
                var videoId = $(this).data('id');
                var newStatus = $(this).data('status');

                $.ajax({
                    url: 'AntarmukaDisplay.php',  // Adjust the URL to point to your update handler
                    method: 'POST',
                    data: {
                        id: videoId,
                        status: newStatus
                    },
                    success: function(response) {
                        // alert('Status updated successfully');
                        location.reload();  // Reload the page to reflect the changes
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->
    <script src="../js/admin.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    </body>
</html>