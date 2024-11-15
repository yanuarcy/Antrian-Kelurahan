<?php
class ApiWhatsappConfig
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
        $query = $this->conn->prepare("UPDATE api_whatsapp SET status = 0");
        $query->execute();

        $query2 = $this->conn->prepare("UPDATE api_whatsapp SET status = :status WHERE id_api_whatsapp = :id");
        $query2->bindParam(':status', $status);
        $query2->bindParam(':id', $id);
        $query2->execute();
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM api_whatsapp where 
                                        id_api_whatsapp like '%$search%'or
                                        no_whatsapp like '%$search%' or
                                        token like '%$search%' or");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }
    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM api_whatsapp");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function createApiWhatsapp($no_whatsapp, $token) {
        $query = "INSERT INTO api_whatsapp (no_whatsapp, token) VALUES (:no_whatsapp, :token)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':no_whatsapp', $no_whatsapp);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM api_whatsapp where id_api_whatsapp=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id, $no_whatsapp, $token){
        $query = $this->conn->prepare('UPDATE api_whatsapp set no_whatsapp=?, token=? where id_api_whatsapp=?');
        $query->bindParam(1, $no_whatsapp);
        $query->bindParam(2, $token);
        $query->bindParam(3, $id);
        $query->execute();
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM api_whatsapp where id_api_whatsapp=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>