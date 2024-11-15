<?php
// Define the file path
$file_path = '../panggilan-antrian/current_antrian.json';

// Load existing queue from the JSON file
$queue = [];
if (file_exists($file_path)) {
    $queue = json_decode(file_get_contents($file_path), true) ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Remove the first entry from the queue as it has been read
    if (!empty($queue)) {
        array_shift($queue); // Remove the first element from the queue
        // Save the updated queue back to the JSON file
        file_put_contents($file_path, json_encode($queue));
    }
}

// Serve the updated queue as JSON
header('Content-Type: application/json');
echo json_encode($queue);
?>
