<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_slike
 *
 * @author stefan
 */
class Model_slike extends CI_Model{
    //put your code here
    public $id;
    public $slika;
    public $mala_slika;
    
    public function __construct() {
        parent::__construct();
    }
    public function upisiSliku()
{
$this->db->insert('galerije',array('naziv_galerije'=>$this->slika, 'male_slike'=>$this->mala_slika));

}
 public function prikazi(){
       $upit="SELECT * FROM galerije";
      return $this->db->query($upit)->result();
    }

function lista() {
        return $this->db->get('galerije')->result();
}
  function obrisi() {
        $this->db->where('id_galerije', $this->id);
        $this->db->delete('galerije');
    }

}