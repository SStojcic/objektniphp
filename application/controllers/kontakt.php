<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kontakt
 *
 * @author stefan
 */
class kontakt extends Ci_Controller {
    
    private $podaci=array();
    public function __construct() {
        parent::__construct();
        $this->podaci['css_data'][]=link_tag("css/bootstrap.min.css","stylesheet","text/css");
           $this->podaci['css_data'][]=link_tag("css/1-col-portfolio.css","stylesheet","text/css");
           $this->podaci['meta_data'][]=  meta('viewport','width=device-width, initial-scale=1');
           $this->podaci['meta_data'][]=  meta('description','Serije,Preporuka');
           $this->podaci['meta_data'][]= meta('author','Stefan Stojcic');
           
    }
    public function index(){
$this->load->helper('form');
  $this->load->view('head');
     
           $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
        $this->load->model('model_autor');
           $this->podaci['autor']=$this->model_autor->prikazi();
           $this->load->view('navigacija',$this->podaci);
          
     $this->load->view('kontakt');
                 $this->load->view('footer');
                 
      
    }
    //put your code here
}