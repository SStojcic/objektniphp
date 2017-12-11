<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelKorisnik
 *
 * @author stefan
 */
class Modelkorisnik extends CI_Model{
    //put your code here
      public $korisnicko_ime;
    public $id_korisnik;
public $uloga;
public $username;
public $lozinka;

     function podaci() {
        $this->db->where('id_korisnik', $this->id_korisnik);
        return $this->db->get('korisnik')->row_array();
    }

    function lista() {
        return $this->db->get('korisnik')->result();
    }
  
    public function prikazisve()
{
$query=$this->db->query('SELECT * FROM korisnik LEFT OUTER JOIN uloge ON 
korisnik.id_uloga=uloge.id_uloga ORDER BY datum_registracije DESC');
return $query->result();
}

  function obrisi() {
        $this->db->where('id_korisnik', $this->id_korisnik);
        $this->db->delete('korisnik');
    }
  public function prikaziJednog()
    {
        $upit = "SELECT * FROM korisnik WHERE id_korisnik = ".$this->id_korisnik;
        $rez = $this->db->query($upit);
        return $rez->result();
    }
    function izmeni() {
        $data = array('korisnicko_ime' => $this->korisnicko_ime,'datum_registracije'=>date("Y-m-d H:i:s"),'lozinka'=>md5($this->lozinka),'email'=>$this->email);
        $this->db->where('id_korisnik', $this->id_korisnik);
        return $this->db->update('korisnik', $data);
    }
    public function unosKorisnika()
{
$podaci=array('korisnicko_ime'=> $this->korisnicko_ime,'lozinka'=> md5($this->lozinka),
'email'=> $this->email,'datum_registracije'=>date("Y-m-d H:i:s"),
'id_uloga'=>2


);
$this->db->insert('korisnik',$podaci);
}
}