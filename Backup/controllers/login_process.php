<?php
// Menghubungkan ke database
$mysqli = new mysqli("localhost", "u812045417_antrian", "Antrian123", "u812045417_antrian");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

session_start();

// Mengambil input dari form
$user = $_POST['username'];
$pass = md5($_POST["password"]);

// Query untuk cek apakah username ada di database
$stmt = $mysqli->prepare("SELECT * FROM member WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    
    // Cek apakah password sesuai
    if ($row['password'] == $pass) {
        
        
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['id_loket'] = $row['id_loket'];

        // Cek status loket
        $stmt2 = $mysqli->prepare("SELECT status FROM loket WHERE id_loket = ?");
        $stmt2->bind_param("i", $row['id_loket']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $loket = $result2->fetch_assoc();

        $stmt3 = $mysqli->prepare("SELECT loket FROM loket WHERE id_loket = ?");
        $stmt3->bind_param("i", $row['id_loket']);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $loket2 = $result3->fetch_assoc();

        $_SESSION['Loket'] = $loket2['loket'];

        if ($loket['status'] == 1) {
            echo "<br><center><h1><div class='alert alert-danger'>
                <p class='text-danger'>Status loket anda sedang digunakan</p></div></h1>
                <a href='../'>Kembali</a>
                </center>";
        } else {
            // Redirect berdasarkan level user
            if ($_SESSION['level'] == 'Admin') {
                $_SESSION['logged_in'] = true;
                echo "<script>console.log('Hai')</script>";
                header("Location: ../");
            } else {
                // Update status loket
                $_SESSION['logged_in'] = true;
                $stmt3 = $mysqli->prepare("UPDATE loket SET status = 1 WHERE id_loket = ?");
                $stmt3->bind_param("i", $_SESSION['id_loket']);
                $stmt3->execute();
                header("Location: ../panggilan-antrian");
            }
        }
    } else {
        echo "<div class='alert alert-danger'>
            <p class='text-danger'>Password tidak sesuai</p></div>";
        header("Location: login.php");
    }
} else {
    echo "<div class='alert alert-danger'>
        <p class='text-danger'>Username tidak ditemukan</p></div>";
    header("Location: ../login");
}

// Menutup koneksi
$stmt->close();
$mysqli->close();
?>
