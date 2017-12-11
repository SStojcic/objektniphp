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
class model_autor extends CI_Model{
    //put your code here
    public $id;
    public $slika;
    public $mala_slika;
    
    public function __construct() {
        parent::__construct();
    }

 public function prikazi(){
       $upit="SELECT * FROM autor";
      return $this->db->query($upit)->result();
    }
}
