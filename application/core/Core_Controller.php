<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Core_Controller
 *
 * @author stefan
 */
class Core_Controller extends CI_Controller {
 
     private $podaci=array();
    public function __construct() {
        parent::__construct();
   }
    //put your code here
   public function load_view($view,$vars=array()){
         $this->load->helper("url");
             $this->load->library("pagination");
          $this->load->helper('form',$vars);
   
        $this->load->view('head',$vars);
           $this->load->view('navigacija',$vars);
              $this->load->view('naslov',$vars);
   $this->load->view('post',$vars);
              $this->load->view('paginacija',$vars);
                 $this->load->view('footer',$vars);
                 $this->load->view($view,$vars);
                 
   }
}
