<?php 
    class DashboardController {
        private $conn;
    
        public function __construct() {
            $hostname = 'localhost';
            $dbname = 'antrian';
            $username = 'root';
            $password = '';
            $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
        }

        public function ShowSearch($search) {
            $query1 = $this->conn->prepare(
                                            "SELECT * FROM member where
                                            email like '%$search%' ");
            // $query1->bindParam(':username', $search);
            $query1->execute();
            $searchdata = $query1->fetchAll();  
            return $searchdata;
    
        }

        public function MemberID($search) {
            $query1 = $this->conn->prepare(
                                            "SELECT * FROM member where
                                            email like '%$search%' ");
            // $query1->bindParam(':username', $search);
            $query1->execute();
            $searchdata = $query1->fetchAll();  
            return $searchdata;
    
        }

        public function countingRow() {
            $Qmember = $this->conn->prepare("SELECT COUNT(*) FROM member where level = 'CS'");
            $Qmember->execute();
            $Membercount = $Qmember->fetchColumn();

            $Qadmin = $this->conn->prepare("SELECT COUNT(*) FROM member where level = 'Admin'");
            $Qadmin->execute();
            $Admincount = $Qadmin->fetchColumn();

            $Qlayanan = $this->conn->prepare("SELECT COUNT(*) FROM pelayanan");
            $Qlayanan->execute();
            $Layanancount = $Qlayanan->fetchColumn();

            $Qloket = $this->conn->prepare("SELECT COUNT(*) FROM loket");
            $Qloket->execute();
            $Loketcount = $Qloket->fetchColumn();

            $Qpemohon = $this->conn->prepare("SELECT COUNT(*) FROM pemohon");
            $Qpemohon->execute();
            $Pemohoncount = $Qpemohon->fetchColumn();

            // $Qorder = $this->conn->prepare("SELECT COUNT(*) FROM order");
            // $Qorder->execute();
            // $Ordercount = $Qorder->fetchColumn();

            return array($Membercount, $Admincount, $Layanancount, $Loketcount, $Pemohoncount);
            

        }
    }

    
    





?>