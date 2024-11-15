<?php
// Include the get_active_token.php to retrieve the active token
include "./get_active_token.php";
$Token = getActiveToken($mysqli);

// Retrieve POST data
$whatsapp = $_POST['whatsapp'];
$nama = $_POST['nama'];
$jenis_layanan = $_POST['jenis_layanan'];
$keterangan = $_POST['keterangan'];
$jenis_pengiriman = $_POST['jenis_pengiriman'];
$nomor_terbaru = $_POST['nomor_terbaru'];

$pesan = "";
if ($jenis_pengiriman === "Dikirim ke rumah") {
    $pesan = "kami akan kirimkan dokumen ke alamat anda.";
} else if ($jenis_pengiriman === "Datang ke kelurahan") {
    $pesan = "Silahkan bisa datang ke kelurahan untuk mengambil dokumen anda.";
} else if ($jenis_pengiriman === "") {
    $pesan = "";
}

// cURL to send the WhatsApp message
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
        'message' => "Halo $nama, terima kasih telah menggunakan layanan kami, teruntuk layanan yang anda pilih:\n\nLayanan: $jenis_layanan.\nNomor antrian: $nomor_terbaru.\nKeterangan: $keterangan.\n\nProses Layanan anda telah selesai, $pesan Terimakasih.",
        'countryCode' => '62',
        'delay' => '2'
    ),
    CURLOPT_HTTPHEADER => array(
        "Authorization: $Token"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
?>
