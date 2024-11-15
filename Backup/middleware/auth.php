<?php
session_start();

// Database connection (replace with your actual database connection details)
$host = 'localhost'; // Your database host
$db = 'u812045417_antrian'; // Your database name
$user = 'u812045417_antrian'; // Your database user
$pass = 'Antrian123'; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        // Fetch the status from the loket table
        $stmt = $pdo->prepare("SELECT status FROM loket WHERE id_loket = :id_loket LIMIT 1");
        $stmt->execute(['id_loket' => $_SESSION['id_loket']]); // Assuming you store the loket_id in the session

        $loket = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the status is 0 and the user is not an Admin
        if ($loket && $loket['status'] == 0 && $_SESSION['level'] !== 'Admin') {
            // Unset session and redirect to index.php if status is 0 and user is not Admin
            session_unset();
            session_destroy();
            echo '<script>alert("Your session has been logged out due to status change."); window.location.href = "/index.php";</script>';
            exit();
        }
        // If the user is an Admin, allow access regardless of status
    } else {
        // If not logged in, redirect to the main page
        header('Location: /index.php');
        exit();
    }
} catch (PDOException $e) {
    // Handle the database connection error
    echo 'Database error: ' . $e->getMessage();
    exit();
}
?>


