<?php
// Include the database connection
$mysqli = new mysqli("localhost", "root", "", "antrian");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Fungsi untuk mengambil video yang aktif
function getActiveVideo($mysqli) {
    $stmt = $mysqli->prepare("SELECT sumber FROM antarmuka WHERE status = 1 LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $video = $result->fetch_assoc();
    $stmt->close();
    return $video;
}

// Mengambil sumber video aktif
$activeVideo = getActiveVideo($mysqli);
$videoSrc = isset($activeVideo['sumber']) ? $activeVideo['sumber'] : "https://www.youtube.com/embed/yobvhX00XQA?si=8YPhD1sNqt8IpH6V";

// Output the video source URL
echo $videoSrc;

// Menutup koneksi
$mysqli->close();
?>
