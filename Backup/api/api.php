<?php
header('Content-Type: application/json');

$db = new mysqli('localhost', 'u812045417_antrian', 'Antrian123', 'u812045417_antrian');
if ($db->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Koneksi database gagal']));
}

function addToQueue($antrian, $loket, $nama = null, $whatsapp = null) {
    global $db;
    $stmt = $db->prepare("INSERT INTO queue (antrian, loket, nama, whatsapp, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssss", $antrian, $loket, $nama, $whatsapp);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function getNextInQueue() {
    global $db;
    $db->begin_transaction();
    $result = $db->query("SELECT * FROM queue WHERE status = 'pending' ORDER BY id ASC LIMIT 1 FOR UPDATE");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db->query("UPDATE queue SET status = 'processing' WHERE id = " . $row['id']);
        $db->commit();
        return $row;
    }
    $db->commit();
    return null;
}

function markQueueAsCompleteAndDelete($id) {
    global $db;
    $db->begin_transaction();
    try {
        // Tandai sebagai selesai
        $stmt = $db->prepare("UPDATE queue SET status = 'completed' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Hapus data
        $stmt = $db->prepare("DELETE FROM queue WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollback();
        return false;
    }
}


// Fungsi lainnya (getNextInQueue, markQueueAsComplete) tetap sama

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? $_GET['action'] ?? '';

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $antrian = $input['antrian'] ?? '';
    $loket = $input['loket'] ?? '';
    $nama = $input['nama'] ?? '';
    $whatsapp = $input['whatsapp'] ?? '';

    if (addToQueue($antrian, $loket, $nama, $whatsapp)) {
        echo json_encode(['status' => 'success', 'message' => 'Antrian ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan antrian']);
    }
} elseif ($action === 'next') {
    // Implementasi untuk 'next' tetap sama
    $next = getNextInQueue();
    if ($next) {
        echo json_encode($next);
    } else {
        echo json_encode(['status' => 'empty', 'message' => 'Tidak ada antrian']);
    }
} elseif ($action === 'complete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $input['id'] ?? 0;
    if (markQueueAsCompleteAndDelete($id)) {
        echo json_encode(['status' => 'success', 'message' => 'Antrian selesai dan dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menandai antrian selesai dan menghapus']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Aksi tidak valid atau metode request salah']);
}

$db->close();
?>