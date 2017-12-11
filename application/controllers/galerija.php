<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of galerija
 *
 * @author stefan
 */
class galerija extends CI_Controller{
    //put your code here
      private $podaci=array();
      private $data=array();
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->load->view('head');
        $this->load->model('model_meni');
        $this->load->model('model_slike');
              $this->podaci['menus']=$this->model_meni->prikazi();
           $this->podaci['slike']=$this->model_slike->prikazi();
        $this->load->view('navigacija',$this->podaci);
            $is_post=$this->input->server('REQUEST_METHOD') == 'POST'; 
        $this->load->library('form_validation');
        $this->load->model('model_slike');
        
        $this->load->view('galerija',$this->data);
          if($is_post){
                  $dugme = $this->input->post('btnUnesi');
                 
                 if($dugme!="")
             {
                    
  
 $file_name = $_FILES['tbSlike']['name'];
$file_size =$_FILES['tbSlike']['size'];
$file_tmp =$_FILES['tbSlike']['tmp_name'];
$file_type=$_FILES['tbSlike']['type'];

$male_slike="thumb_".$file_name;
move_uploaded_file($file_tmp,"images/".$file_name);
$this->model_slike->slika=$file_name;
$this->model_slike->mala_slika=$male_slike;
              
    
              
                      $config['image_library'] = 'gd2';
        
$config['source_image']	= './images/'.$file_name;

$config['create_thumb'] = false;
$config['new_image'] = 'thumb_'.$file_name;

$config['maintain_ratio'] = TRUE;
$config['width']	= 250;
$config['height']	= 250;




$this->load->library('image_lib', $config); 

$this->image_lib->resize();
                      
$this->model_slike->upisiSliku();

  
                         $this->podaci['obavestenje'] = "Podaci su uneti u bazu!";
                  
}
             
        
       
    
          }}}