<?php
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../config/database.php";

  // mengecek data post dari ajax
  if (isset($_POST['id']) && isset($_POST['loket'])) {
    // ambil data hasil post dari ajax
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $loket = mysqli_real_escape_string($mysqli, $_POST['loket']);
    $resetCallingBy = isset($_POST['reset_calling_by']); // Check if resetting calling_by

    $Loket = $loket !== "" ? "Loket $loket" : ""; 

    // Determine status based on whether we are resetting the call
    // $status = $resetCallingBy ? "0" : "1";
    $callingBy = $resetCallingBy ? "" : $Loket; // Set or clear calling_by based on reset flag
    // tentukan nilai status
    // $status = "1";
    // ambil tanggal dan waktu update data
    $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

    // sql statement untuk update data di tabel "tbl_antrian" berdasarkan "id"
    $update = mysqli_query($mysqli, "UPDATE tbl_antrian
                                     SET calling_by='$callingBy'
                                     WHERE id='$id'")
                                     or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

    
  }
}
