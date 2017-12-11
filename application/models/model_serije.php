<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_serije
 *
 * @author stefan
 */
class model_serije extends CI_Model{

   public $id_korisnik;
    public $id_serije;
    public $naziv;
    public $opis;
    public $slika;

    public function __construct() {
        parent::__construct();
        
    }

    public function record_count() {
        return $this->db->count_all("serije");
    }

    public function fetch_countries($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("serije");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

public function upisiSeriju()
{
$this->db->insert('serije',array('naziv'=> $this->naziv, 'slika'=>$this->slika,'opis'=> $this->opis,'vreme'=>date("Y-m-d H:i:s")));

}

     function izmeni() {
        $podaci = array('naziv' => $this->naziv);
        $this->db->where('id', $this->id_serije);
        return $this->db->update('serije', $podaci);
    }

    function obrisi() {
        $this->db->where('id_serije', $this->id);
        $this->db->delete('serije');
    }

    function lista() {
        return $this->db->get('serije')->result();
    }
function listaa() {
    $this->db->where('id_korisnik', $this->id_korisnik);
        return $this->db->get('serije')->result();
    }
    function podaci() {
        $this->db->where('id_korisnik', $this->id_korisnik);
        return $this->db->get('serije')->row_array();
    }
 public function prikaziSerijeKorisnika(){
        
   $this->db->select("*");
   $this->db->join("korisnik","serije.id_korisnik=korisnik.id_korisnik");
   $this->db->where("serije.id_korisnik",$this->id_korisnik);
          return $this->db->get('serije')->result();
   
   }
     public function upisiSerijuK()
{
$this->db->insert('serije',array('naziv'=> $this->naziv, 'slika'=>$this->slika,'opis'=> $this->opis,'id_korisnik'=>$this->id_korisnik,'vreme'=>date("Y-m-d H:i:s")));

}

}