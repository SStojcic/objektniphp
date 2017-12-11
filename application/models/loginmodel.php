<?php


class Loginmodel extends CI_Model{
    
    
  public $korisnicko_ime;
    public $id_korisnik;
public $uloga;
public $username;
public $lozinka;


public function __construct() {
parent::__construct();
$this->load->database();
}


    public function login(){
     

$query = $this->db->query("SELECT id_korisnik,korisnicko_ime,lozinka,email,uloga FROM korisnik INNER
JOIN uloge ON korisnik.id_uloga=uloge.id_uloga WHERE korisnicko_ime='".$this->korisnicko_ime."' AND
lozinka='$this->lozinka '");
$row=$query->row();
return $row;
}
       
       

        public function registracija()
{
$podaci=array(
'korisnicko_ime'=> $this->korisnicko_ime,
'lozinka'=> ($this->lozinka),
'email'=> $this->email,
'datum_registracije'=>date("Y-m-d H:i:s"),

'id_uloga'=>2
);
if($this->db->insert('korisnik',$podaci))
{
return true;
}
else
{
return false;
}

}
}