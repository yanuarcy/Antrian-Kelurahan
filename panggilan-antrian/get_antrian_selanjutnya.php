<?php
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../config/database.php";

  // ambil tanggal sekarang
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // sql statement untuk menampilkan data "no_antrian" dari tabel "tbl_antrian" berdasarkan "tanggal" dan "status = 0"
  $query = mysqli_query($mysqli, "SELECT no_antrian FROM tbl_antrian 
                                  WHERE tanggal='$tanggal' AND status='0' 
                                  ORDER BY no_antrian ASC LIMIT 8")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil jumlah baris data hasil query
  $rows = mysqli_num_rows($query);

  // cek hasil query
  // jika data "no_antrian" ada
  // if ($rows <> 0) {
  //   // ambil data hasil query
  //   $data = mysqli_fetch_assoc($query);
  //   // buat variabel untuk menampilkan data
  //   $no_antrian = $data['no_antrian'];

  //   // tampilkan data
  //   echo number_format($no_antrian, 0, '', '.');
  // } 
  // // jika data "no_antrian" tidak ada
  // else {
  //   // tampilkan "-"
  //   echo "-";
  // }

  if ($rows > 0) {
      $antrian_selanjutnya = [];
      while ($data = mysqli_fetch_assoc($query)) {
          $antrian_selanjutnya[] = $data['no_antrian'];
      }

      // Mengirimkan data sebagai JSON tanpa karakter tambahan
      echo json_encode($antrian_selanjutnya, JSON_UNESCAPED_SLASHES);
  } else {
      echo json_encode([]);
  }
}
