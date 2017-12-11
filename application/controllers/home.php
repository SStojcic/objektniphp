<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author stefan
 */
class home extends Core_Controller {
 
    private $podaci=array();
 
    
    public function __construct() {
        parent::__construct();
       
           $this->podaci['meta_data'][]=  meta('viewport','width=device-width, initial-scale=1');
           $this->podaci['meta_data'][]=  meta('description','Serije,Preporuka');
           $this->podaci['meta_data'][]= meta('author','Stefan Stojcic');
            $this->load->helper("url");
             $this->load->library("pagination");
             
          
    }
    public function index(){
      
              $this->load->helper('form');
     
        $this->load->view('head',$this->podaci);
            $this->load->model('model_meni');
            $this->load->model('model_serije');
             $config = array();
             
                      $config['base_url'] = 'http://serije.byethost3.com/home/index';
        $config["total_rows"] = $this->model_serije->record_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->model_serije->
            fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        
        $this->podaci['menus']=$this->model_meni->prikazi();
      
           $this->load->view('navigacija',$this->podaci);
         
             $this->load->view('post',$data);
             $this->load->library('image_lib');
             $config['image_library'] = 'gd2';
$config['source_image']	= 'http://localhost/images/jessica.jpg';
$config['create_thumb'] = TRUE;
$config['maintain_ratio'] = TRUE;
$config['width']	= 75;
$config['height']	= 50;

$this->load->library('image_lib', $config); 

$this->image_lib->resize();
              $this->load->view('paginacija',$data);
                         $this->podaci['anketa_podaci']= $this->anketa();
$this->load->view("anketa",$this->podaci);
                 $this->load->view('footer');
               
                     
      
       
    }
    
public function anketaAjax()
{
       $this->podaci['base_url']= base_url();
    $this->load->model("modelanketa");
$rez=$this->modelanketa->izaberiAnketu();
echo '<div id="anketa">';
echo"<div class='anketagore'>";
echo "<p class='anketatekst'>".$rez->tekst."</p>";
echo '</div>';
echo "<div class='anketadole'>
<a onclick='anketaAjax();return false;'><img style='width:40px;height:40px;' src='".base_url()."images/next2.png'/></a>
</div></div>";
}
public function anketa()
{
$this->load->model("modelanketa");
$rez=$this->modelanketa->izaberiAnketu();
return $rez;}
}

   //put your code here


  