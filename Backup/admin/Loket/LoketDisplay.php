<?php 
    include "../../config/LoketConfig.php";
    include '../../middleware/auth.php';
    // include "../../controllers/login_process.php";
    $lib = new LoketConfig();
    $data_loket = $lib->show();

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $status_hapus = $lib->delete($id);
        if($status_hapus){
            header('Location: LoketDisplay.php');
        }
    }

    session_start();
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        $memberID = $_SESSION['id_loket'];
    }

    if(isset($_GET['Gender'])){
        $selectedGender = $_GET['Gender'];
        $gender = $lib->getItemsByCategory($selectedGender);
    }

    if(isset($_POST['cari'])) {
        $search = $_POST['keyword'];
        $data_search = $lib->ShowSearch($search);
    }

    if (isset($_POST['register'])) {
        $kode_antrian = $_POST["kode_antrian"];
        $jenis_pelayanan = $_POST["jenis_pelayanan"];
        $keterangan_pelayanan = $_POST["keterangan_pelayanan"];
        $addPelayanan = new PelayananConfig();
        $addPelayanan->createPelayanan($kode_antrian, $jenis_pelayanan, $keterangan_pelayanan);
        if ($addPelayanan) {
            header('Location: ../Pelayanan/PelayananDisplay.php');
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
    <link rel="stylesheet" href="css/AddPelayanan.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Admin - LoketDisplay</title>


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
                        <a class="nav-link active" href="LoketDisplay.php"><i class="bi bi-key pr-2" style="font-size: 27px;"></i>Data Loket</a><hr class="bg-secondary">
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="../apiWhatsapp/DataApiDisplay.php"><i class="bi bi-link-45deg pr-2" style="font-size: 27px;"></i>Data Api Whatsapp</a><hr class="bg-secondary">
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="../Antarmuka/AntarmukaDisplay.php"><i class="bi bi-tv pr-3" style="font-size: 27px;"></i>Data Antarmuka</a><hr class="bg-secondary">
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="../Pemohon/PemohonDisplay.php"><i class="bi bi-person pr-3" style="font-size: 27px;"></i>Data Pemohon</a><hr class="bg-secondary">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 p-5 pt-2">
                <h3>DATA LOKET</h3><hr>
                <form action="" class="form-inline my-2 my-lg-0 ml-auto" method="post" id="search">
                    <input name="keyword" class="form-control" type="text" placeholder="Search" aria-label="Search" autocomplete="off">
                    <button name="cari" class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Search</button>
                </form>

                
                <table class="table table-striped table-bordered table-hover mt-3">
                    <thead class="thead bg-info">
                        <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ID LOKET</th>
                        <th scope="col">NAMA CUSTOMER SERVICE</th>
                        <th scope="col">LOKET</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">STATUS PEMANGGILAN</th>
                        <th colspan="3" class="text-center" scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php    
                        if(isset($_POST['cari'])){
                            $no = 1;
                            foreach($data_search as $row){
                                $status_button_class = $row['status'] == 1 ? 'btn-success' : 'btn-secondary';
                                $status_text = $row['status'] == 1 ? 'Online' : 'Offline';
                                
                                $status_button_class2 = $row['status'] == 1 ? 'btn-success' : 'btn-secondary';
                                $status_text2 = $row['status'] == 1 ? 'Online' : 'Offline';

                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$row['id_loket']."</td>";
                                echo "<td>".$row['loket']."</td>";
                                echo "<td class='text-center'>
                                        <button class='btn $status_button_class' disabled>
                                            $status_text
                                        </button>
                                    </td>";
                                echo "<td class='text-center'>
                                        <button class='btn $status_button_class2' disabled>
                                            $status_text2
                                        </button>
                                    </td>";
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdateLoket.php?id=".$row['id_loket']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='LoketDisplay.php?delete=".$row['id_loket']."'><i class='bi bi-trash'></i></a></td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                        else{
                            $no = 1;
                            foreach($data_loket as $row){
                                $status_button_class = $row['status'] == 1 ? 'btn-success' : 'btn-secondary';
                                $status_text = $row['status'] == 1 ? 'Online' : 'Offline';

                                $status_button_class2 = $row['status_pemanggilan'] == 1 ? 'btn-success' : 'btn-secondary';
                                $status_text2 = $row['status_pemanggilan'] == 1 ? 'Calling' : 'Standby';

                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$row['id_loket']."</td>";
                                echo "<td>".$row['nama_cs']."</td>";
                                echo "<td>".$row['loket']."</td>";
                                echo "<td class='text-center'>
                                        <button class='btn $status_button_class' disabled>
                                            $status_text
                                        </button>
                                    </td>";
                                echo "<td class='text-center'>
                                        <button class='btn $status_button_class2' disabled>
                                            $status_text2
                                        </button>
                                    </td>";
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdateLoket.php?id=".$row['id_loket']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='LoketDisplay.php?delete=".$row['id_loket']."'><i class='bi bi-trash'></i></a></td>";
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

    <!-- Optional JavaScript; choose one of the two! -->

    <script>
        // ======================================================
        // About Modal Box
        // Get the modal
        var modal = document.getElementById("AddModal");

        // // Get the button that opens the modal
        var btn = document.getElementById("AddBtn");

        // // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = "none";
        //     }
        // }
    </script>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../js/admin.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    </body>
</html>