<?php
// Include the database connection
$mysqli = new mysqli("localhost", "u812045417_antrian", "Antrian123", "u812045417_antrian");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Fungsi untuk mengambil video yang aktif
function getActiveLoket($mysqli) {
    $stmt = $mysqli->prepare("SELECT loket FROM loket WHERE status_pemanggilan = 1 LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $loket = $result->fetch_assoc();
    $stmt->close();
    return $loket;
}

// Mengambil sumber video aktif
$loket = getActiveLoket($mysqli);
$Loket = isset($loket['loket']) ? $loket['loket'] : 0;

// Output the video source URL
echo "LOKET ".$Loket;

// Menutup koneksi
$mysqli->close();
?>
