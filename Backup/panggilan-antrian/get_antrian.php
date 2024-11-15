<?php
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../config/database.php";

  // ambil tanggal sekarang
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // Get the jenis_antrian filter from the request
    $jenis_antrian = isset($_GET['jenis_antrian']) ? $_GET['jenis_antrian'] : 'Offline';

    // Modify the query to filter by jenis_antrian
    $query = mysqli_query($mysqli, "SELECT id, tanggal, nama, no_whatsapp, alamat, jenis_layanan, keterangan, no_antrian, jenis_pengiriman, calling_by, status FROM tbl_antrian 
                                    WHERE tanggal='$tanggal' AND jenis_antrian='$jenis_antrian'")
                                    or die('Ada kesalahan pada query tampil data: ' . mysqli_error($mysqli));
    
    $rows = mysqli_num_rows($query);

    if ($rows <> 0) {
        $response = array();
        $response["data"] = array();

        while ($row = mysqli_fetch_assoc($query)) {
            $data['id'] = $row["id"];
            $data['nama'] = $row["nama"];
            $data['no_whatsapp'] = $row["no_whatsapp"];
            $data['alamat'] = $row["alamat"];
            $data['jenis_layanan'] = $row["jenis_layanan"];
            $data['keterangan'] = $row["keterangan"];
            $data['no_antrian'] = $row["no_antrian"];
            $data['jenis_pengiriman'] = $row["jenis_pengiriman"];
            $data['calling_by'] = $row["calling_by"];
            $data['status'] = $row["status"];
            $data['tanggal'] = $row["tanggal"];

            array_push($response["data"], $data);
        }

        echo json_encode($response);
    } else {
        $response = array();
        $response["data"] = array();

        $data['id'] = "";
        $data['nama'] = "-";
        $data['no_whatsapp'] = "-";
        $data['alamat'] = "-";
        $data['jenis_layanan'] = "-";
        $data['keterangan'] = "-";
        $data['no_antrian'] = "-";
        $data['jenis_pengiriman'] = "-";
        $data['calling_by'] = "";
        $data['status'] = "";
        $data['tanggal'] = "";

        array_push($response["data"], $data);

        echo json_encode($response);
    }
}
