<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelAnketa
 *
 * @author stefan
 */
class modelAnketa extends CI_Model {
    //put your code here
    public $id_anketa;
public $tekst;


public function __construct() {
parent::__construct();
$this->load->database();
}
public function izaberiAnketu()
{
$query="SELECT * FROM anketa";
$rez= $this->db->query($query);
$br=$rez->num_rows();
$id_anketa= rand(1, $br);
$query="SELECT * FROM anketa WHERE id_anketa=".$id_anketa;
$rezultat= $this->db->query($query);
return $rezultat->row();
}
}