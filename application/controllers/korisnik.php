<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of korisnik
 *
 * @author stefan
 */
class korisnik extends CI_Controller{
    //put your code here
     private $podaci=array();
    private $data = array();
     public function __construct() {
        parent::__construct();
       $sesija=($this->session->userdata('uloga') == 'korisnik');
        if(empty($sesija)){
            //nije ulogovan
            redirect(); // ovako vraca na base_url
        }
    }
    public function index()
    {
        // prikaz pocetne stranice admin panela
        $podaci = array();
        $podaci['linkovi'] = array(
           anchor('korisnik/prikazi','Pregledajte profil'),
           anchor('korisnik/unesi','Unesi seriju'),

        );
        
        $this->load->view('head');
      $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
        $this->load->view('korisnik', $podaci); // prosledjivanje podataka ka View-u
        
        $this->load->view('footer');
    }
    
    public function prikazi(){
        
        $this->load->model('modelkorisnik');
              $this->load->view('head');
            
                   $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
             
             
             
              $this->load->library('table');
              $tmpl = array (
                    'table_open'          => '<table border="3" cellpadding="4" cellspacing="2">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

$this->table->set_template($tmpl);
$this->load->model('model_serije');

$this->model_serije->id_korisnik=$this->session->userdata('id_korisnik');


             $korisnici = $this->model_serije->prikaziSerijeKorisnika();
         
             
             $this->table->set_heading('Id','Naziv','Opis','Vreme postavljanja','Obrisi');
       
             $br = 1;
             foreach($korisnici as $korisnik)
             {
                 // $id = $uloga->id;
                 $korisnickoime= $korisnik->naziv;
                 $opis=$korisnik->opis;
                 $vremeregistracije=$korisnik->vreme;
           
           
                 $link_edit=anchor('korisnik/brisanje/serije/'.$korisnik->id_serije,'Obrisi');

                 $this->table->add_row($br++, $korisnickoime,$opis,$vremeregistracije, $link_edit);
                 
             }
             $this->data['tabela_korisnik'] = $this->table->generate();
             
             $this->load->view('korisnik/profil', $this->data);
         
     
        $this->load->view('footer');
        
}

       public function unesi($tip = null)
               {
     
              $this->load->view('head');
            
                   $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
             $is_post=$this->input->server('REQUEST_METHOD') == 'POST'; 
        $this->load->library('form_validation');
		
        if($tip!=null && $tip=='serije')
         {
                    
                    
             if($is_post){
                  $dugme = $this->input->post('btnUnesi');
                 
                 if($dugme!="")
             {
       $file_name = $_FILES['tbSlike']['name'];
$file_size =$_FILES['tbSlike']['size'];
$file_tmp =$_FILES['tbSlike']['tmp_name'];
$file_type=$_FILES['tbSlike']['type'];

move_uploaded_file($file_tmp,"images/".$file_name);
$naziv_serije=$this->input->post("tbNaslov");
$opis_serije=$this->input->post("taTekst");


$this->load->model("model_serije");
$this->model_serije->naziv=$naziv_serije;
$this->model_serije->opis=$opis_serije;
$this->model_serije->slika=$file_name;
   $this->model_serije->id_korisnik=$this->session->userdata('id_korisnik');
                     $this->form_validation->set_rules('tbNaslov','Naziv serije','trim|required');
                     $this->form_validation->set_rules('taTekst','Opis','trim|required');
                     
                 
                     
                    if (empty($_FILES['tbSlike']['name']))
{
    $this->form_validation->set_rules('tbSlike', 'Slika', 'required');
}
              
                     if($this->form_validation->run())
                     {
                     
                      
$this->model_serije->upisiSerijuK();

  
                         $this->podaci['obavestenje'] = "Podaci su uneti u bazu!";
                  
}
             }}
          
        
             }
  
             $this->load->view('korisnik/serije', $this->data);
             $this->load->view("footer");
         }
        
         public function brisanje($tip = null, $id = null)
    {
        // akcija za brisanje bilo kog entiteta iz baze
        // primer poziva funkcije: Administracija/izmeni/korisnici/1 - $tip = 'korisnici', $id = 1
        
        $this->load->view('head');
        $id= $this->uri->segment(4);
       
        
       
          if($tip!=null && $id!=null && $tip=="serije")
        {
            // DELETE ULOGA
            $this->load->model('model_serije');
            $this->model_serije->id=$id;
            $this->model_serije->obrisi();
            redirect('korisnik/');
            //$this->load->view('admin/uloge');
        }
    }
}
