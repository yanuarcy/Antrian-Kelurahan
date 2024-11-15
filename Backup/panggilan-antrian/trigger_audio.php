<?php
// Define the file path
$file_path = '../panggilan-antrian/current_antrian.json';

// Load existing queue from the JSON file
$queue = [];
if (file_exists($file_path)) {
    $queue = json_decode(file_get_contents($file_path), true) ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $antrian = $_POST['antrian'];
    // $nama = $_POST['nama'];
    $loket = $_POST['loket'];

    // Check if 'nama' is set in the POST data
    $nama = isset($_POST['nama']) ? $_POST['nama'] : null;

    // Add new call to the queue
    $newCall = ['antrian' => $antrian, 'loket' => $loket];
    if ($nama !== null) {
        $newCall['nama'] = $nama;
    }
    $queue[] = $newCall;

    // Save the updated queue to the JSON file
    file_put_contents($file_path, json_encode($queue));
}

// Serve the queue as JSON
header('Content-Type: application/json');
echo json_encode($queue);
?>
