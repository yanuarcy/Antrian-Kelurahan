<?php
class AntarmukaConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'localhost';
        $dbname = 'u812045417_antrian';
        $username = 'u812045417_antrian';
        $password = 'Antrian123';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }

    public function getActiveVideo() {
        $query = $this->conn->prepare("SELECT sumber FROM antarmuka WHERE status = 1 LIMIT 1");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        // Set all entries to inactive
        $query = $this->conn->prepare("UPDATE antarmuka SET status = 0");
        $query->execute();

        $query2 = $this->conn->prepare("UPDATE antarmuka SET status = :status WHERE id_antarmuka = :id");
        $query2->bindParam(':status', $status);
        $query2->bindParam(':id', $id);
        $query2->execute();
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM antarmuka where 
                                        id_antarmuka like '%$search%'or
                                        keterangan like '%$search%' or
                                        nama like '%$search%' or
                                        sumber like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }
    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM antarmuka");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function createAntarmuka($keterangan, $nama_video, $durasi_video, $alamat_url) {
        $query = "INSERT INTO antarmuka (keterangan, nama, durasi_video, sumber) VALUES (:keterangan, :nama, :durasi_video, :sumber)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':nama', $nama_video);
        $stmt->bindParam(':durasi_video', $durasi_video);
        $stmt->bindParam(':sumber', $alamat_url);
        $stmt->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM antarmuka where id_antarmuka=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id, $nama_video, $durasi_video, $keterangan, $sumber){
        $query = $this->conn->prepare('UPDATE antarmuka set keterangan=?, nama=?, durasi_video=?, sumber=? where id_antarmuka=?');
        $query->bindParam(1, $keterangan);
        $query->bindParam(2, $nama_video);
        $query->bindParam(3, $durasi_video);
        $query->bindParam(4, $sumber);
        $query->bindParam(5, $id);
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