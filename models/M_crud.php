<?php
class M_crud extends CI_Model {
    
    // Fungsi untuk mendapatkan data berdasarkan kriteria
    public function get_id($table, $where) {
        return $this->db->get_where($table, $where);
    }
    
    // Fungsi untuk mengedit data
    public function edit($table, $data, $where) {
        return $this->db->update($table, $data, $where);
    }
}
?>