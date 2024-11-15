<?php
class PelayananConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'localhost';
        $dbname = 'antrian';
        $username = 'root';
        $password = '';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }

    public function getPelayananKeteranganByJenis($jenis) {
        $query = $this->conn->prepare("SELECT keterangan FROM pelayanan WHERE jenis = :jenis");
        $query->bindParam(':jenis', $jenis);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM pelayanan where 
                                        id_pelayanan like '%$search%'or
                                        kode_antrian like '%$search%' or
                                        jenis like '%$search%' or
                                        keterangan like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }
    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM pelayanan");
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
        $query = $this->conn->prepare("SELECT * FROM pelayanan where id_pelayanan=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id, $kode_antrian, $jenis, $keterangan){
        $query = $this->conn->prepare('UPDATE pelayanan set kode_antrian=?, jenis=?, keterangan=? where id_pelayanan=?');
        $query->bindParam(1, $kode_antrian);
        $query->bindParam(2, $jenis);
        $query->bindParam(3, $keterangan);
        $query->bindParam(4, $id);
        $query->execute();
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM pelayanan where id_pelayanan=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>