<?php
class PemohonConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'localhost';
        $dbname = 'u812045417_antrian';
        $username = 'u812045417_antrian';
        $password = 'Antrian123';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }

    // Method to fetch kode_pemohon from the database
    public function getKodePemohon($kode_pemohon) {
        $query = $this->conn->prepare("SELECT kode_pemohon FROM pemohon WHERE kode_pemohon = :kode_pemohon");
        $query->bindParam(':kode_pemohon', $kode_pemohon);
        $query->execute();
        return $query->fetch();
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM pemohon where 
                                        id_pemohon like '%$search%'or
                                        nama like '%$search%' or
                                        alamat like '%$search%' or
                                        no_whatsapp like '%$search%' or
                                        email like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }

    public function ShowWithDate($start_date, $end_date ){
        $query = "SELECT * FROM pemohon WHERE tanggal BETWEEN :start_date AND :end_date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }
    
    public function show()
    {
        $query = $this->conn->prepare("
        SELECT 
            p.*,
            ta.updated_date
        FROM 
            pemohon p
        LEFT JOIN 
            tbl_antrian ta ON p.id_pemohon = ta.id
            ");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    // public function createPemohon($fullName, $email, $whatsapp, $address, $jenis_layanan, $keterangan_layanan) {
    //     $query = "INSERT INTO pemohon (nama, email, no_whatsapp, alamat, jenis_layanan, keterangan) VALUES (:nama, :email, :no_whatsapp, :alamat, :jenis_layanan, :keterangan)";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':nama', $fullName);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':no_whatsapp', $whatsapp);
    //     $stmt->bindParam(':alamat', $address);
    //     $stmt->bindParam(':jenis_layanan', $jenis_layanan);
    //     $stmt->bindParam(':keterangan', $keterangan_layanan);
    //     $stmt->execute();
    // }

    public function createPemohonWithAntrian($fullName, $whatsapp, $address, $jenis_layanan, $keterangan_layanan, $jenis_antrian, $jenis_pengiriman) {
        // Mulai transaksi
        $this->conn->beginTransaction();

        try {
            // Ambil tanggal sekarang
            $tanggal = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

            // Ambil Kode_Antrian dari tabel "pelayanan" jika jenis_layanan = "KTP/KK/KIA"
            $kodeAntrian = '';
            if ($jenis_layanan == "KTP/KK/KIA/IKD") {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "AKTA")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "PINDAH DATANG")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "LAYANAN KELURAHAN")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "SKT/SKAW")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "KONSULTASI")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            }

            // SQL statement untuk menampilkan data "no_antrian" terakhir pada tabel "tbl_antrian" berdasarkan "tanggal" dan "kodeAntrian"
            // $query = $this->conn->prepare("SELECT max(no_antrian) as nomor FROM tbl_antrian WHERE tanggal = :tanggal AND LEFT(no_antrian, 1) = :kodeAntrian");
            // $query->bindParam(':tanggal', $tanggal);
            // $query->bindParam(':kodeAntrian', $kodeAntrian);
            // $query->execute();
            
            // Mendapatkan tanggal dan waktu saat ini dalam zona waktu yang diinginkan (GMT+7)
            $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

            // Format tanggal menjadi Y-m-d
            $tanggalNow = $dateTime->format('Y-m-d');

            $query = $this->conn->prepare("
                SELECT no_antrian as nomor
                FROM tbl_antrian 
                WHERE tanggal = :tanggal 
                AND LEFT(no_antrian, 1) = :kodeAntrian
                ORDER BY CAST(SUBSTRING(no_antrian, 2) AS UNSIGNED) DESC 
                LIMIT 1
            ");
            $query->bindParam(':tanggal', $tanggalNow);
            $query->bindParam(':kodeAntrian', $kodeAntrian);
            $query->execute();

            // Ambil hasil query
            $data = $query->fetch(PDO::FETCH_ASSOC);

            // Tentukan "no_antrian"
            // if ($data && $data['nomor'] !== null) {
            //     // Ambil angka dari nomor antrian terakhir dengan memisahkan huruf dan angka
            //     preg_match('/(\D+)(\d+)/', $data['nomor'], $matches);
            //     $huruf = $matches[1]; // Mengambil huruf, misal 'B'
            //     $angka = (int)$matches[2]; // Mengambil angka setelah huruf, misal '10'
                
            //     // Tentukan nomor antrian berikutnya
            //     $no_antrian = $huruf . ($angka + 1); // Menambah angka 1 untuk nomor berikutnya
            // } else {
            //     $no_antrian = $kodeAntrian . "1"; // Memulai dari 1 jika belum ada antrian
            // }

            if ($data && $data['nomor'] !== null) {
                // Ambil angka dari nomor antrian terakhir
                echo "Data : ".$data['nomor'];
                $angka = (int)substr($data['nomor'], 1); // menghapus karakter pertama dan mengubah sisa string menjadi integer
                echo "Angka : $angka";
                $no_antrian = $kodeAntrian . ($angka + 1); // Menambah angka 1 untuk nomor berikutnya
                echo "No Antrian : $no_antrian";
            } else {
                $no_antrian = $kodeAntrian . "1"; // Memulai dari 1 jika belum ada antrian
            }

            // SQL statement untuk insert data ke tabel "tbl_antrian"
            $insertAntrian = $this->conn->prepare(
                "INSERT INTO tbl_antrian(tanggal, nama, no_whatsapp, alamat, jenis_layanan, keterangan, no_antrian, jenis_antrian, jenis_pengiriman) 
                 VALUES(:tanggal, :nama, :no_whatsapp, :alamat, :jenis_layanan, :keterangan, :no_antrian, :jenis_antrian, :jenis_pengiriman)"
            );
            $insertAntrian->bindParam(':tanggal', $tanggal);
            $insertAntrian->bindParam(':nama', $fullName);
            $insertAntrian->bindParam(':no_whatsapp', $whatsapp);
            $insertAntrian->bindParam(':alamat', $address);
            $insertAntrian->bindParam(':jenis_layanan', $jenis_layanan);
            $insertAntrian->bindParam(':keterangan', $keterangan_layanan);
            $insertAntrian->bindParam(':no_antrian', $no_antrian);
            $insertAntrian->bindParam(':jenis_antrian', $jenis_antrian);
            $insertAntrian->bindParam(':jenis_pengiriman', $jenis_pengiriman);
            $insertAntrian->execute();

            // Function to generate a random 6-character alphanumeric code
            function generateRandomCode($length = 6) {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $randomCode = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomCode .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $randomCode;
            }

            // Generate a random kode_pemohon
            $kode_pemohon = generateRandomCode();
            $email = "NULL";

            // SQL statement untuk insert data ke tabel "pemohon"
            $insertPemohon = $this->conn->prepare(
                "INSERT INTO pemohon (tanggal, kode_pemohon, nama, email, no_whatsapp, alamat, jenis_layanan, keterangan, jenis_antrian, jenis_pengiriman) 
                 VALUES (:tanggal, :kode_pemohon, :nama, :email, :no_whatsapp, :alamat, :jenis_layanan, :keterangan, :jenis_antrian, :jenis_pengiriman)"
            );
            $insertPemohon->bindParam(':tanggal', $tanggal);
            $insertPemohon->bindParam(':kode_pemohon', $kode_pemohon);
            $insertPemohon->bindParam(':nama', $fullName);
            $insertPemohon->bindParam(':email', $email);
            $insertPemohon->bindParam(':no_whatsapp', $whatsapp);
            $insertPemohon->bindParam(':alamat', $address);
            $insertPemohon->bindParam(':jenis_layanan', $jenis_layanan);
            $insertPemohon->bindParam(':keterangan', $keterangan_layanan);
            $insertPemohon->bindParam(':jenis_antrian', $jenis_antrian);
            $insertPemohon->bindParam(':jenis_pengiriman', $jenis_pengiriman);
            $insertPemohon->execute();

            // Commit transaksi
            $this->conn->commit();

            echo "Sukses";
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $this->conn->rollBack();
            echo "Gagal: " . $e->getMessage();
        }
    }

    public function createPemohonLamaWithAntrian($kode_pemohon = null, $jenis_layanan, $keterangan_layanan, $jenis_antrian, $jenis_pengiriman) {
        $this->conn->beginTransaction();
        try {
            // Ambil tanggal sekarang
            $tanggal = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

            // Jika kode_pemohon diinputkan, periksa keberadaannya di database
            if ($kode_pemohon) {
                $queryKodePemohon = $this->conn->prepare("SELECT * FROM pemohon WHERE kode_pemohon = :kode_pemohon");
                $queryKodePemohon->bindParam(':kode_pemohon', $kode_pemohon);
                $queryKodePemohon->execute();
                $pemohonData = $queryKodePemohon->fetch(PDO::FETCH_ASSOC);

                if ($pemohonData) {
                    // Gunakan data yang ada untuk membuat entri baru
                    $fullName = $pemohonData['nama'];
                    $email = $pemohonData['email'];
                    $whatsapp = $pemohonData['no_whatsapp'];
                    $address = $pemohonData['alamat'];
                    // $jenis_layanan = $pemohonData['jenis_layanan'];
                    // $keterangan_layanan = $pemohonData['keterangan'];
                } else {
                    // Jika kode_pemohon tidak ditemukan, lempar exception
                    throw new Exception("Kode Pemohon tidak ditemukan.");
                }
            }

            // Ambil Kode_Antrian dari tabel "pelayanan" jika jenis_layanan = "KTP/KK/KIA"
            $kodeAntrian = '';
            if ($jenis_layanan == "KTP/KK/KIA/IKD") {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "AKTA")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "PINDAH DATANG")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "LAYANAN KELURAHAN")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "SKT/SKAW")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            } else if ($jenis_layanan == "KONSULTASI")  {
                $queryKode = $this->conn->prepare("SELECT Kode_Antrian FROM pelayanan WHERE Jenis = :jenis");
                $queryKode->bindParam(':jenis', $jenis_layanan);
                $queryKode->execute();
                $kodeData = $queryKode->fetch(PDO::FETCH_ASSOC);

                // Tentukan kode antrian sesuai jenis layanan
                if ($kodeData && $kodeData['Kode_Antrian'] !== null) {
                    $kodeAntrian = $kodeData['Kode_Antrian']; // Misalnya, bisa A, B, C, atau D
                }
            }
            
            // Mendapatkan tanggal dan waktu saat ini dalam zona waktu yang diinginkan (GMT+7)
            $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

            // Format tanggal menjadi Y-m-d
            $tanggalNow = $dateTime->format('Y-m-d');

            $query = $this->conn->prepare("
                SELECT no_antrian as nomor
                FROM tbl_antrian 
                WHERE tanggal = :tanggal 
                AND LEFT(no_antrian, 1) = :kodeAntrian
                ORDER BY CAST(SUBSTRING(no_antrian, 2) AS UNSIGNED) DESC 
                LIMIT 1
            ");
            $query->bindParam(':tanggal', $tanggalNow);
            $query->bindParam(':kodeAntrian', $kodeAntrian);
            $query->execute();

            // Ambil hasil query
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data && $data['nomor'] !== null) {
                // Ambil angka dari nomor antrian terakhir
                echo "Data : ".$data['nomor'];
                $angka = (int)substr($data['nomor'], 1); // menghapus karakter pertama dan mengubah sisa string menjadi integer
                echo "Angka : $angka";
                $no_antrian = $kodeAntrian . ($angka + 1); // Menambah angka 1 untuk nomor berikutnya
                echo "No Antrian : $no_antrian";
            } else {
                $no_antrian = $kodeAntrian . "1"; // Memulai dari 1 jika belum ada antrian
            }

            // SQL statement untuk insert data ke tabel "tbl_antrian"
            $insertAntrian = $this->conn->prepare(
                "INSERT INTO tbl_antrian(tanggal, nama, no_whatsapp, alamat, jenis_layanan, keterangan, no_antrian, jenis_antrian, jenis_pengiriman) 
                 VALUES(:tanggal, :nama, :no_whatsapp, :alamat, :jenis_layanan, :keterangan, :no_antrian, :jenis_antrian, :jenis_pengiriman)"
            );
            $insertAntrian->bindParam(':tanggal', $tanggal);
            $insertAntrian->bindParam(':nama', $fullName);
            $insertAntrian->bindParam(':no_whatsapp', $whatsapp);
            $insertAntrian->bindParam(':alamat', $address);
            $insertAntrian->bindParam(':jenis_layanan', $jenis_layanan);
            $insertAntrian->bindParam(':keterangan', $keterangan_layanan);
            $insertAntrian->bindParam(':no_antrian', $no_antrian);
            $insertAntrian->bindParam(':jenis_antrian', $jenis_antrian);
            $insertAntrian->bindParam(':jenis_pengiriman', $jenis_pengiriman);
            $insertAntrian->execute();
            
            $email = "NULL";

            // SQL statement untuk insert data ke tabel "pemohon"
            $insertPemohon = $this->conn->prepare(
                "INSERT INTO pemohon (tanggal, kode_pemohon, nama, email, no_whatsapp, alamat, jenis_layanan, keterangan, jenis_antrian, jenis_pengiriman) 
                 VALUES (:tanggal, :kode_pemohon, :nama, :email, :no_whatsapp, :alamat, :jenis_layanan, :keterangan, :jenis_antrian, :jenis_pengiriman)"
            );
            $insertPemohon->bindParam(':tanggal', $tanggal);
            $insertPemohon->bindParam(':kode_pemohon', $kode_pemohon);
            $insertPemohon->bindParam(':nama', $fullName);
            $insertPemohon->bindParam(':email', $email);
            $insertPemohon->bindParam(':no_whatsapp', $whatsapp);
            $insertPemohon->bindParam(':alamat', $address);
            $insertPemohon->bindParam(':jenis_layanan', $jenis_layanan);
            $insertPemohon->bindParam(':keterangan', $keterangan_layanan);
            $insertPemohon->bindParam(':jenis_antrian', $jenis_antrian);
            $insertPemohon->bindParam(':jenis_pengiriman', $jenis_pengiriman);
            $insertPemohon->execute();

            // Commit transaksi
            $this->conn->commit();

            echo "Sukses";
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $this->conn->rollBack();
            echo "Gagal: " . $e->getMessage();
        }
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM antarmuka where id_antarmuka=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id, $nama_video, $keterangan, $sumber){
        $query = $this->conn->prepare('UPDATE antarmuka set keterangan=?, nama=?, sumber=? where id_antarmuka=?');
        $query->bindParam(1, $keterangan);
        $query->bindParam(2, $nama_video);
        $query->bindParam(3, $sumber);
        $query->bindParam(4, $id);
        $query->execute();
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM antarmuka where id_antarmuka=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>