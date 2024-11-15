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
    $namaPetugas = mysqli_real_escape_string($mysqli, $_POST['namaPetugas']);
    
    // tentukan nilai status
    $status = "1";
    // ambil tanggal dan waktu update data
    $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

    // Periksa status saat ini dari antrian
    $check_status = mysqli_query($mysqli, "SELECT status FROM tbl_antrian WHERE id='$id'");
    $current_status = mysqli_fetch_assoc($check_status)['status'];

    if ($current_status == "0") {
      // Jika status saat ini adalah 0, update status dan tanggal
    //   $status = "1";
      $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
  
      $update = mysqli_query($mysqli, "UPDATE tbl_antrian
                                       SET status='$status', updated_date='$updated_date'
                                       WHERE id='$id'")
          or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
    } else {
      // Jika status sudah 1, tidak perlu mengupdate apapun
      // Atau Anda bisa menampilkan pesan bahwa status sudah diupdate sebelumnya
      echo "Status sudah diupdate sebelumnya.";
    }

    // Set all entries to inactive
    $resetStatus = mysqli_query($mysqli, "UPDATE loket SET status_pemanggilan = 0")
    or die('Ada kesalahan pada query reset status: ' . mysqli_error($mysqli));

    // Update the loket entry that matches the session's Loket
    $updateStatusPemanggilan = mysqli_query($mysqli, "UPDATE loket
                                          SET status_pemanggilan = '$status'
                                          WHERE loket = '$loket'")
                    or die('Ada kesalahan pada query update status pemanggilan: ' . mysqli_error($mysqli));

    // cek apakah update berhasil
    if ($update) {
      // sql statement untuk mendapatkan nama dari tabel "tbl_antrian" berdasarkan "id"
      $query = mysqli_query($mysqli, "SELECT nama FROM tbl_antrian WHERE id='$id'")
                                      or die('Ada kesalahan pada query select : ' . mysqli_error($mysqli));
      $data = mysqli_fetch_assoc($query);
      $nama = $data['nama'];
      $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

      // sql statement untuk update status pada tabel "pemohon" berdasarkan "nama"
      $updatePemohon = mysqli_query($mysqli, "UPDATE pemohon
                                              SET status='$status', petugas='$namaPetugas', tanggal_dilayani='$updated_date'
                                              WHERE nama='$nama'")
                                              or die('Ada kesalahan pada query update pemohon : ' . mysqli_error($mysqli));
    }
  }
}
