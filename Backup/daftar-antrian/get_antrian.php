<?php
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../config/database.php";

   // Include the get_active_token.php to retrieve the active token
   include "./get_active_token.php";

   // Token retrieved from get_active_token.php
  //  $Token = $Token; // This is already set in get_active_token.php
  $Token = getActiveToken($mysqli);

  // ambil tanggal sekarang
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // Fetch the latest queue data and pemohon data
  $query = mysqli_query($mysqli, "
  SELECT a.nama, a.no_antrian, a.jenis_layanan, a.keterangan, a.jenis_antrian, a.jenis_pengiriman, p.kode_pemohon
  FROM tbl_antrian a
  JOIN pemohon p ON a.nama = p.nama  -- Assuming 'nama' is the common column; adjust if different
  WHERE a.tanggal = '$tanggal'
  ORDER BY a.id DESC 
  LIMIT 1
  ") or die('Ada kesalahan pada query tampil data: ' . mysqli_error($mysqli));

  if ($data = mysqli_fetch_assoc($query)) {
    $nama = $data['nama'];
    $nomor_terbaru = $data['no_antrian'];
    $jenis_layanan = $data['jenis_layanan'];
    $keterangan = $data['keterangan'];
    $jenis_antrian = $data['jenis_antrian'];
    $jenis_pengiriman = $data['jenis_pengiriman'];
    $kode_pemohon = $data['kode_pemohon'];

    $Pesan = "";
    
    $PesanKngDikirimRumah = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu, customer service kami akan segera menghubungi Anda terkait proses layanan ini. Untuk informasi lebih lanjut mengenai layanan yang Anda pilih, Anda dapat mengakses link berikut: https://wargaklampid-dispendukcapil.surabaya.go.id/app. Jika mengalami kesulitan, customer service kami akan siap memandu Anda. Dokumen akan dikiriman ke alamat anda ketika selesai.\n\nTerima kasih atas kesabaran Anda.";
    $PesanKngDatangKelurahan = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu, customer service kami akan segera menghubungi Anda terkait proses layanan ini. Untuk informasi lebih lanjut mengenai layanan yang Anda pilih, Anda dapat mengakses link berikut: https://wargaklampid-dispendukcapil.surabaya.go.id/app. Jika mengalami kesulitan, customer service kami akan siap memandu Anda. Anda akan menerima pesan ketika dokumen telah selesai diproses dan bisa diambil ke kelurahan.\n\nTerima kasih atas kesabaran Anda.";
    
    $PesanSSWAlphaDikirimRumah = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu, customer service kami akan segera menghubungi Anda terkait proses layanan ini. Untuk informasi lebih lanjut mengenai layanan yang Anda pilih, Anda dapat mengakses link berikut: https://sswalfa.surabaya.go.id/. Jika mengalami kesulitan, customer service kami akan siap memandu Anda. Dokumen akan dikiriman ke alamat anda ketika selesai.\n\nTerima kasih atas kesabaran Anda.";
    $PesanSSWAlphaDatangKelurahan = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu, customer service kami akan segera menghubungi Anda terkait proses layanan ini. Untuk informasi lebih lanjut mengenai layanan yang Anda pilih, Anda dapat mengakses link berikut: https://sswalfa.surabaya.go.id/. Jika mengalami kesulitan, customer service kami akan siap memandu Anda. Anda akan menerima pesan ketika dokumen telah selesai diproses dan bisa diambil ke kelurahan.\n\nTerima kasih atas kesabaran Anda.";
    
    $PesanKonsultasiOnline = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu, customer service kami akan menghubungi Anda untuk melanjutkan proses konsultasi. Harap tetap terhubung dan siapkan waktu Anda saat dihubungi.\n\nTerima kasih atas kepercayaan dan kesabarannya.";
    $PesanKonsultasiOffline = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu, Anda akan segera dilayani sesuai urutan antrian. Harap bersabar hingga nomor antrian anda dipanggil.\n\nTerima kasih atas kehadiran dan kesabarannya.";
    
    
    if ($jenis_antrian === "Online") {
      if ($jenis_pengiriman === "Dikirim ke rumah") {
          if(in_array($jenis_layanan, ["KTP/KK/KIA/IKD", "AKTA", "PINDAH DATANG"])) {
              $Pesan = $PesanKngDikirimRumah;
          } else if (in_array($jenis_layanan, ["LAYANAN KELURAHAN", "SKT/SKAW"])) {
              $Pesan = $PesanSSWAlphaDikirimRumah;
          }
      } else if ($jenis_pengiriman === "Datang ke kelurahan") {
        if(in_array($jenis_layanan, ["KTP/KK/KIA/IKD", "AKTA", "PINDAH DATANG"])) {
              $Pesan = $PesanKngDatangKelurahan;
          } else if (in_array($jenis_pelayanan, ["LAYANAN KELURAHAN", "SKT/SKAW"])) {
              $Pesan = $PesanSSWAlphaDatangKelurahan;
          }
      } else if ($jenis_layanan === "KONSULTASI") {
          $Pesan = $PesanKonsultasiOnline;
      }
    } else if ($jenis_antrian === "Offline") {
        if ($jenis_layanan === "KONSULTASI") {
            $Pesan = $PesanKonsultasiOffline;
        } else {
            $Pesan = "Halo $nama, terima kasih telah mendaftar untuk ;\n\nlayanan : $jenis_layanan.\nNomor antrian : $nomor_terbaru.\nKeterangan : $keterangan.\nKode Pemohon: $kode_pemohon.\n\nMohon menunggu panggilan sesuai dengan nomor antrian Anda.";
        }
    }

    // Fetch the no_whatsapp from the pemohon table based on the nama
    $whatsappQuery = mysqli_query($mysqli, "SELECT no_whatsapp FROM pemohon WHERE nama='$nama' LIMIT 1")
        or die('Ada kesalahan pada query tampil data whatsapp : ' . mysqli_error($mysqli));

    if ($whatsappData = mysqli_fetch_assoc($whatsappQuery)) {
        $whatsapp = $whatsappData['no_whatsapp'];

        // Send WhatsApp message if whatsapp number is found
        if (!empty($whatsapp)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $whatsapp,
                    'message' => $Pesan,
                    'countryCode' => '62', //optional
                    'delay' => '2'
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $Token" //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }
    }

    // Return the data in JSON format
    echo json_encode(array('nama' => $nama, 'no_antrian' => $nomor_terbaru, 'jenis_layanan' => $jenis_layanan, 'keterangan' => $keterangan));
  } else {
  // If no data found, return an empty JSON object
  echo json_encode(array('nama' => '', 'no_antrian' => '', 'jenis_layanan' => '', 'keterangan' => ''));
  }
}
