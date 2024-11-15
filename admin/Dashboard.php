<?php
    include "../controllers/DashboardController.php";
    include '../middleware/auth.php';
    $lib = new DashboardController();
    $data = $lib -> countingRow();

    // session_start();
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        // $memberID = $_SESSION['memberid'];
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
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Admin - Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="#"><img src="../assets/img/LogoCompany.png" alt="Logo Kelurahan" style="height: 50px;">SELAMAT DATANG ADMIN | Kelurahan Jemurwonosari - Antrian</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <form class="form-inline my-2 my-lg-0 ml-auto">

        </form>

        <div class="icon ml-4">
            <h5>
            <a href="../" style="font-size: 25px; color: black; text-decoration: none;">Exit <i class="bi bi-box-arrow-right mr-3" data-toggle="tooltip" title="Exit"></i></a>
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
                    <a class="navbar-brand" href="Dashboard.php"><?php echo $nama ?></a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Dashboard.php"><i class="bi bi-speedometer2 pr-2 pl-1" style="font-size: 30px;"></i>Dashboard</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Member/MemberDisplay.php"><i class="bi-people pr-2 pl-1" style="font-size: 27px;"></i>Data Member</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Pelayanan/PelayananDisplay.php"><i class="bi bi-layout-text-sidebar-reverse pr-2" style="font-size: 27px;"></i>Data Pelayanan</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Loket/LoketDisplay.php"><i class="bi bi-key pr-2" style="font-size: 27px;"></i>Data Loket</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="apiWhatsapp/DataApiDisplay.php"><i class="bi bi-link-45deg pr-2" style="font-size: 27px;"></i>Data Api Whatsapp</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Antarmuka/AntarmukaDisplay.php"><i class="bi bi-tv pr-3" style="font-size: 27px;"></i>Data Antarmuka</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Pemohon/PemohonDisplay.php"><i class="bi bi-person pr-3" style="font-size: 27px;"></i>Data Pemohon</a><hr class="bg-secondary">
                </li>
                </ul>
            </div>
        </div>

    
        <div class="col-md-10 p-5 pt-2">
            <h3 id="Home">Dashboard</h3><hr>

            <div class="row text-white justify-content-center">

                <div class="card bg-info ml-3 mr-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-people mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH MEMBER</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[0] ?></div>
                        <a href="Member/MemberDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

                <div class="card bg-danger ml-5 mr-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-person-lines-fill mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH ADMIN</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[1] ?></div>
                        <a href="Member/MemberDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

                <div class="card bg-success mr-4 ml-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-box-seam mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH LAYANAN</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[2] ?></div>
                        <a href="Pelayanan/PelayananDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

            </div>
            
            <div class="row text-white justify-content-center mt-5 mr-5">
                
                <div class="card bg-warning ml-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-tags mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH LOKET</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[3] ?></div>
                        <a href="Loket/LoketDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>
                
                <div class="card bg-primary ml-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-cart mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH PEMOHON</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[4] ?></div>
                        <a href="Pemohon/PemohonDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center gmaps mt-5" style="width: 70%; margin: 0 auto;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d296.25915424648787!2d112.73952623171327!3d-7.320609931875862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb13306a2bd7%3A0x4bf5704f955cb1ca!2sKelurahan%20Jemur%20Wonosari%20Wonocolo!5e0!3m2!1sid!2sid!4v1724334642539!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>














    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>
</html>

