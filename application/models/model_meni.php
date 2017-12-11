<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_Meni
 *
 * @author stefan
 */
class Model_meni extends CI_Model{
 
    public $id_meni;
    public $naslov_meni;
    public $putanja;
    
    public function __construct() {
    
        parent::__construct();
        $this->load->database();
    }
    public function prikazi(){
       $upit="SELECT * FROM meni";
      return $this->db->query($upit)->result();
    }
}