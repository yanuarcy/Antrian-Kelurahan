<?php 
    include './login_process.php';

    $mysqli = new mysqli("localhost", "u812045417_antrian", "Antrian123", "u812045417_antrian");

    // Cek koneksi
    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }

    session_start();
    if(isset($_SESSION['level'])){
        if ($_SESSION['level'] == 'CS') {
            $rolUser = $_SESSION['level'];
            // unset($_SESSION['logged_in']);
            $stmt3 = $mysqli->prepare("UPDATE loket SET status = 0 WHERE id_loket = ?");
                $stmt3->bind_param("i", $_SESSION['id_loket']);
                $stmt3->execute();
            session_destroy();
            header("Location: ../");
        } else {
            $rolAdmin = $_SESSION['RoleAdmin'];
            session_destroy();
            header("Location: ../");
        }
    }
    // if(isset($_SESSION['RoleAdmin'])){
    //     $rolAdmin = $_SESSION['RoleAdmin'];
    //     session_destroy();
    //     // unset($_SESSION['nama']);
    //     // unset($_SESSION['memberid']);
    //     // unset($_SESSION['username']);
    //     // unset($_SESSION['RoleAdmin']);
    //     header("Location: index.php");
    // }
    exit;

?>