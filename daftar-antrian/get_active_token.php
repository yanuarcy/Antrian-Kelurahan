<?php
// Include the database connection
$mysqli = new mysqli("localhost", "root", "", "antrian");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Fungsi untuk mengambil video yang aktif
function getActiveToken($mysqli) {
    $stmt = $mysqli->prepare("SELECT token FROM api_whatsapp WHERE status = 1 LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $token = $result->fetch_assoc();
    $stmt->close();
    return isset($token['token']) ? $token['token'] : "";
}

// Mengambil sumber video aktif
// $activeToken = getActiveToken($mysqli);
// $Token = isset($activeToken['token']) ? $activeToken['token'] : "";

// Output the video source URL
// echo $Token;

// Menutup koneksi
// $mysqli->close();
?>
