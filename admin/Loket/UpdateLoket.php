<?php
    include '../../config/LoketConfig.php';
    include '../../middleware/auth.php';
    // include "../../config/LoginConfig.php";
    // session_start();
    if(isset($_SESSION['id_loket'])){
        $id_loket = $_SESSION['id_loket'];
    }

    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
    }
    
    $lib = new LoketConfig();
    if(isset($_GET['id'])){
        $id = $_GET['id']; 
        $data_loket = $lib->get_by_id($id);
        $loket = $data_loket['loket'];
        $nama_cs = $data_loket['nama_cs'];
        $status = $data_loket['status'];
    }
    else
    {
        header('Location: LoketDisplay.php');
    }

    $data_loket = $lib->show();
    
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
        // $id = $_POST['id'];
        $loket = $_POST['loket'];
        $status = $_POST['status'];
        $status_update = $lib->update($id, $loket, $status);
        if($status_update)
        {
            header('Location: LoketDisplay.php');
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/dashboard.css">

    <title>UpdateMember</title>

    <style>
        /* The Modal (background) */
        .modal {
            display: block; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 26%; /* Could be more or less, depending on screen size */
            height: 90%;
        }

        /* Modal Header */
        .modal-header {
            margin: auto;
            text-align: center;
            display: block;
            margin-top: -6%;
        }

        /* Modal Body */
        .modal-body .input-form {
            display: flex;
            flex-direction: column;
            margin: 2%;
            width: 100%;
        }

        .input-form .nama {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }
        
        .input-form .gender {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .email {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .password {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .telp {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .alamat {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .Button {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            background-color: #f13a11;
            color: white;
            text-transform: uppercase;
            outline: none;
            border: none;
            padding: 2%;
            margin: 3%;
            text-align: center;
            cursor: pointer;
        }

        .input-form .Button:hover {
            background-color: #171819;
            color: #f13a11;
        }

        .input-form .Button::selection {
            background-color: transparent;
        }

        .input-form .checkbox {
            margin-top: 5%;
            margin-bottom: -33px;
            margin-left: -38px;
            width: 100px;
            height: 20px;

        }

        .input-form .permission {
            font-size: 18px;
            margin-left: 30px;
            margin-top: 2%;
        }

        .input-form .permission a {
            color: #f13a11;
        }

        .input-form .permission a:hover {
            color: #171819;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            display: flex;
            justify-content: right;
            font-size: 28px;
            font-weight: bold;
            padding-bottom: 20px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Responsive Modal */
        @media screen and (max-width: 1500px) {
            .modal-content {
                width: 35%;
                height: 90%;
            }
        }

        @media screen and (max-width: 1200px) {
            .modal-content {
                width: 36%;
                height: 87%;
            }

            .modal-header .ModalTittle {
                font-size: var(--h3-font-size);
            }
        }

        @media screen and (max-width: 1000px) {
            .modal-content {
                width: 46%;
                height: 90%;
            }
        }

        @media screen and (max-width: 885px) {
            .modal-content {
                width: 50%;
                height: 88%;
            }
        }

        @media screen and (max-width: 815px) {
            .input-form .nama {
                font-size: var(--base-font-size);
            }
            .input-form .email {
                font-size: var(--base-font-size);
            }
            .input-form .telp {
                font-size: var(--base-font-size);
            }
            .input-form .message {
                font-size: var(--base-font-size);
            }
            .input-form .Button {
                font-size: var(--base-font-size);
            }
            .input-form .permission {
                font-size: var(--base-font-size);
            }

            .modal-content {
                width: 55%;
                height: 82%;
            }
        }

        @media screen and (max-width: 630px) {
            .modal-content {
                width: 62%;
                height: 80%;
                margin: 10% auto;
            }
        }

        @media screen and (max-width: 560px) {
            .modal-content {
                width: 65%;
                height: 75%;
            }

            .modal-header .ModalTittle {
                font-size: var(--h5-font-size);
            }

            .input-form .nama {
                font-size: var(--menu-font-size);
            }
            .input-form .email {
                font-size: var(--menu-font-size);
            }
            .input-form .telp {
                font-size: var(--menu-font-size);
            }
            .input-form .message {
                font-size: var(--menu-font-size);
            }
            .input-form .Button {
                font-size: var(--menu-font-size);
            }
            .input-form .permission {
                font-size: var(--menu-font-size);
            }
        }

        @media screen and (max-width: 500px) {
            .modal-content {
                margin: 18% auto;
                width: 75%;
                height: 78%;
            }
        }

        @media screen and (max-width: 425px) {
            .modal-header .ModalTittle {
                font-size: var(--h6-font-size);
            }

            .input-form .nama {
                font-size: 12px;
            }
            .input-form .email {
                font-size: 12px;
            }
            .input-form .telp {
                font-size: 12px;
            }
            .input-form .message {
                font-size: 12px;
            }
            .input-form .Button {
                font-size: 12px;
            }
            .input-form .permission {
                font-size: 12px;
            }

            .input-form .permission a {
                font-size: 12px;
            }

            .modal-content {
                height: 69%;
            }
        }

        @media screen and (max-width: 380px) {
            .modal-header .ModalTittle {
                font-size: var(--p-font-size);
            }

            .input-form .nama {
                font-size: 10px;
            }
            .input-form .email {
                font-size: 10px;
            }
            .input-form .telp {
                font-size: 10px;
            }
            .input-form .message {
                font-size: 10px;
            }
            .input-form .Button {
                font-size: 10px;
            }
            .input-form .permission {
                font-size: 10px;
                margin-top: 5%;
            }

            .input-form .permission a {
                font-size: 10px;
            }

            .input-form .checkbox {
                height: 15px;
            }

            .modal-content {
                height: 60%;
                margin: 34% auto;
            }
        }
        /* Akhir Responsive Modal */
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
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdatePelayanan.php?id=".$row['id_loket']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='PelayananDisplay.php?delete=".$row['id_loket']."'><i class='bi bi-trash'></i></a></td>";
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
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdatePelayanan.php?id=".$row['id_loket']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='PelayananDisplay.php?delete=".$row['id_loket']."'><i class='bi bi-trash'></i></a></td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                    ?>
                        
                    <!-- <i class="bi bi-pencil-fill"></i> -->
                    </tbody>
                </table>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        
                        <div class="modal-header">
                            <h2 class="ModalTittle">Update</h2>
                            <h2 class="ModalTittle">Loket Data</h2>
                        </div>

                        <div class="modal-body">
                            <form class="input-form" method="POST" role="form">
                                <label for="itemID">Loket ID : <?php echo $id ?> </label>
                                <label for="itemID">Nama CS : <?php echo $nama_cs ?> </label>
                                <label for="status">Status: <?php echo ($status == 0) ? 'Offline' : 'Online'; ?></label>
                                <label for="loket">Loket</label>
                                <input class="nama" id="nama" name="loket" type="text" value="<?php echo $loket ?>">
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Offline</option>
                                    <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Online</option>
                                </select>
                                <input class="Button" name="submit" type="submit" value="Kirim" readonly>
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    

    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            window.location = "LoketDisplay.php";
        }


    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>
</html>