<?php
class LoketConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'localhost';
        $dbname = 'antrian';
        $username = 'root';
        $password = '';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }

    public function updateStatus($id, $status) {
        // Set all entries to inactive
        $query = $this->conn->prepare("UPDATE antarmuka SET status_pemanggilan = 0");
        $query->execute();

        $query2 = $this->conn->prepare("UPDATE antarmuka SET status_pemanggilan = :status_pemanggilan WHERE id_loket = :id");
        $query2->bindParam(':status_pemanggilan', $status);
        $query2->bindParam(':id', $id);
        $query2->execute();
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM loket where 
                                        id_loket like '%$search%'or
                                        nama_cs like '%$search%' or
                                        loket like '%$search%' or
                                        status like '%$search%' or");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }
    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM loket");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function createPelayanan($kode_antrian, $jenis_pelayanan, $keterangan_pelayanan) {
        $query = "INSERT INTO pelayanan (kode_antrian, jenis, keterangan) VALUES (:kode_antrian, :jenis_pelayanan, :keterangan_pelayanan)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kode_antrian', $kode_antrian);
        $stmt->bindParam(':jenis_pelayanan', $jenis_pelayanan);
        $stmt->bindParam(':keterangan_pelayanan', $keterangan_pelayanan);
        $stmt->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM loket where id_loket=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id, $loket, $status){
        $query = $this->conn->prepare('UPDATE loket set loket=?, status=? where id_loket=?');
        $query->bindParam(1, $loket);
        $query->bindParam(2, $status);
        $query->bindParam(3, $id);
        $query->execute();
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM loket where id_loket=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>