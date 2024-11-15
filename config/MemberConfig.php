<?php
class MemberConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'localhost';
        $dbname = 'antrian';
        $username = 'root';
        $password = '';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }

    public function UpdatePw($Psswd, $memberIDnoLogin){
        $query = $this->conn->prepare("UPDATE member set password = :password where id_loket = :id_loket ");
        // $query->bindParam(1, $Psswd);
        $query->bindParam(':password', $Psswd);
        $query->bindParam(':id_loket', $memberIDnoLogin);

        $query->execute();
        return $query->rowCount();
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM member where 
                                        id_loket like '%$search%'or
                                        nama like '%$search%' or
                                        email like '%$search%' or
                                        username like '%$search%' or
                                        telp like '%$search%' or
                                        alamat like '%$search%' or
                                        level like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }

    public function getItemsByCategory($selectedGender) {
        if($selectedGender == "All") {
            $query = "SELECT * FROM member";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        else if ($selectedGender == "P"){
            $query = "SELECT * FROM member where gender = :gender";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':gender', $selectedGender);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        else if ($selectedGender == "L"){
            $query = "SELECT * FROM member where gender = :gender";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':gender', $selectedGender);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM member");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function createMember($name, $gender, $loket, $email, $username, $password, $telp, $alamat, $level) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO member (nama, gender, email, username, password, telp, alamat, level) VALUES (:name, :gender, :email, :username, :password, :telp, :alamat, :level)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', md5($password));
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':level', $level);
        $stmt->execute();

        $id_loket = $this->conn->lastInsertId();
        $status = 0;

        $query2 = "INSERT INTO loket (id_loket, nama_cs, loket, status, status_pemanggilan) VALUES (:id_loket, :nama_cs, :loket, :status, :status_pemanggilan)";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':id_loket', $id_loket);
        $stmt2->bindParam(':nama_cs', $name);
        $stmt2->bindParam(':loket', $loket);
        $stmt2->bindParam(':status', $status);
        $stmt2->bindParam(':status_pemanggilan', $status);
        $stmt2->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM member where id_loket=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id,$nama, $gender, $email, $username, $password, $telp, $alamat){
        $query = $this->conn->prepare('UPDATE member set nama=?, gender=?, email=?, username=?, password=?, telp=?, alamat=? where id_loket=?');
        $query->bindParam(1, $nama);
        $query->bindParam(2, $gender);
        $query->bindParam(3, $email);
        $query->bindParam(4, $username);
        $query->bindParam(5, $password);
        $query->bindParam(6, $telp);
        $query->bindParam(7, $alamat);
        $query->bindParam(8, $id);

        $query->execute();
        // return $query->rowCount();

        $query2 = $this->conn->prepare('UPDATE loket set nama_cs=? where id_loket=?');
        $query2->bindParam(1, $nama);
        $query2->bindParam(2, $id);

        $query2->execute();
        return $query2->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM member where id_loket=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>