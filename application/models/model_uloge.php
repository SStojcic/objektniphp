<?php
class Modeluloge extends CI_Model{
    //put your code here
    public $id;
    public $uloga;
    
    public function __construct() {
        parent::__construct();
    }
    
    function unesi() {
        $podaci = array('naziv' => $this->naziv);
        $this->db->insert('uloge', $podaci);
        return $this->db->insert_id();
    }

    function izmeni() {
        $podaci = array('uloga' => $this->uloga);
        $this->db->where('id_uloga', $this->id);
        return $this->db->update('uloge', $podaci);
    }

    function obrisi() {
        $this->db->where('id', $this->id);
        $this->db->delete('uloge');
    }

    function lista() {
        return $this->db->get('uloge')->result();
    }

    function podaci() {
        $this->db->where('id_uloga', $this->id);
        return $this->db->get('uloge')->row_array();
    }
}
?>