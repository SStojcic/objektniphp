<?php

class administracija extends CI_Controller{
    private $podaci=array();
    private $data = array();
    
        public function __construct() {
        parent::__construct();
   
     $sesija=($this->session->userdata('uloga') == 'admin');
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
           anchor('administracija/unesi/korisnici','Upravljanje korisnicima'),
           anchor('administracija/unesi/serije','Upravljanje serijama'),
           anchor('administracija/unesi/anketa','Upravljanje anketom'),
            anchor('administracija/unesi/galerija','Upravljanje galerijom')
        );
        
        $this->load->view('head');
      $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
        $this->load->view('administracija', $podaci); // prosledjivanje podataka ka View-u
        
        $this->load->view('footer');
    }
    
    public function unesi($tip = null)
    {
        // akcija za unos bilo kog entiteta u bazu
        // primer poziva funkcije: Administracija/unesi/korisnici - $tip = 'korisnici'
        
        $this->load->view('head');
        $is_post=$this->input->server('REQUEST_METHOD') == 'POST'; 
        $this->load->library('form_validation');
      
        
         
        
       if($tip!=null && $tip=='anketa'){
           
              
                   $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
             
           
           
             if($is_post)
                     {
                    $dugme = $this->input->post('btnUnesi');
           if($dugme!=""){
               
            $tekst=$this->input->post("taTekst");
       
                  $this->load->model('modelanketa','anketa');
                  $this->anketa->tekst=$tekst;
                  $this->anketa->upisiAnketu();
           }
            
    
                 
             }
            
            
                 $this->load->model('modelanketa','anketa');
             $ankete=$this->anketa->sveAnkete();
             $this->load->library('table');
             $this->table->set_template(array('table_open'=>'<table class="table" border="1">'));
             $this->table->set_heading('ID','Tekst','Obrisi');
             $br=1;
           foreach($ankete as $anketa)
             {
                 // $id = $uloga->id;
                 $id = $anketa->id_anketa;
          $tekst=$anketa->tekst;
                
              
                 $link_delete=anchor('administracija/brisanje/anketa/'.$anketa->id_anketa,'Obrisi');
                 $this->table->add_row($id,$tekst, $link_delete);
                 
             }
             $this->data['tabela']=$this->table->generate();
             $this->load->view('admin/anketa', $this->data);
            
           
         }
        
      
        
     if($tip!=null && $tip=='serije')
         {
             $this->load->model('model_serije');
             
            
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
             $serije = $this->model_serije->lista();
             $this->table->set_heading('Id','Naziv','Opis','Vreme','Izmeni','Obrisi');
       
             $br = 1;
             foreach($serije as $serija)
             {
                 // $id = $uloga->id;
                 $naziv = $serija->naziv;
                 $opis=$serija->opis;
                $vreme=$serija->vreme;
                 $link=anchor('administracija/izmeniSeriju/'.$serija->id_serije,'Izmeni');
                 $link_delete=anchor('administracija/brisanje/serije/'.$serija->id_serije,'Obrisi');
                 $this->table->add_row($br++, $naziv,$opis,$vreme,$link, $link_delete);
                 
             }
             $this->data['tabela_uloge'] = $this->table->generate();
             
             $this->load->view('serije', $this->data);
         }
        if($tip!=null && $tip=='galerija')
         {
             $this->load->model('model_slike');
             
            
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
             $slike = $this->model_slike->lista();
             $this->table->set_heading('Id','Naziv slike','Obrisi');
       
             $br = 1;
             foreach($slike as $slika)
             {
                 // $id = $uloga->id;
                 $naziv = $slika->naziv_galerije;
               
                 
 $link_delete = anchor('administracija/brisanje/galerija/'.$slika->id_galerije, 'Obrisi');
                 $this->table->add_row($br++, $naziv, $link_delete);
                 
             }
             
             $this->data['tabela_uloge'] = $this->table->generate();
             
             $this->load->view('galerije', $this->data);
             
         }
    
     if($tip!=null && $tip=='korisnici')
         {
           $podaci = array();
        $podaci['linkovi'] = array(
           anchor('administracija/unesi/korisnici','Upravljanje korisnicima'),
           anchor('administracija/unesi/serije','Upravljanje serijama'),
           anchor('administracija/unesi/anketa','Upravljanje anketom'),
            anchor('administracija/unesi/galerija','Upravljanje galerijom')
        );
        
        $this->load->view('head');
      $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
         
                    $uneti_podaci = array();
                 if($is_post) {
                  $dugme = $this->input->post('btnUnesi');
                               if($dugme!="")
                 {
                     $korisnicko_ime = $this->input->post('tbKorIme');
                     $lozinka = $this->input->post('tbLozinka');
                     $lozinkaponovo = $this->input->post('tbLozinkaPonovo');
                     $email = $this->input->post('tbEmail');
       
                     $this->form_validation->set_rules('tbKorIme','Korisnicko ime','trim|required|min_length|callback_proveraKorIme');
                     $this->form_validation->set_rules('tbLozinka','Lozinka','trim|required|matches[tbLozinkaPonovo]');
                     $this->form_validation->set_rules('tbLozinkaPonovo','Lozinka ponovo','trim|required');
                     $this->form_validation->set_rules('tbEmail','E-mail','trim|required|valid_email');
                  
                     
                     $this->form_validation->set_message('required','Poje %s je prazno.');
                     $this->form_validation->set_message('min_length[5]','Poje %s mora imati minimalno %d karaktera.');
                     $this->form_validation->set_message('proveraKorIme','Polje %s nije u ispravnom formatu');
                     $this->form_validation->set_message('matches','Polja %s i %s se ne poklapaju!');
                     $this->form_validation->set_message('valid_email','Poje %s je neispravno.');
            
                     
                     if($this->form_validation->run())
                     {
                     $this->load->model("modelkorisnik","korisnik");
                     $this->korisnik->korisnicko_ime=$korisnicko_ime;
                     $this->korisnik->lozinka=$lozinka;
                     $this->korisnik->email=$email;
                        $this->korisnik->unosKorisnika();
               
  
                         $this->data['obavestenje'] = "Podaci su uneti u bazu!";
                          
                     } else
                    {
                        $uneti_podaci['tbKorIme'] = $korisnicko_ime;
                        
                        $uneti_podaci['tbLozinka'] = $lozinka;
                         $uneti_podaci['tbLozinkaPonovo'] = $lozinkaponovo;
                          $uneti_podaci['tbEmail'] = $email;
                    }
                  
                 }}
                       $this->data['btnKorIme']= array(
                 'id' => 'tbKorIme', 
                 'name' => 'tbKorIme', 
                 'class' => 'form-control', 
                 'value'=> isset($uneti_podaci['tbKorIme'])? $uneti_podaci['tbKorIme'] : ''
             ); 
                                  $this->data['btnLozinka']= array(
                 'id' => 'tbLozinka', 
                 'name' => 'tbLozinka', 
                 'class' => 'form-control', 
                 'value'=> isset($uneti_podaci['tbLozinka'])? $uneti_podaci['tbLozinka'] : ''
             ); 
                                                        $this->data['btnLozinkaPonovo']= array(
                 'id' => 'tbLozinkaPonovo', 
                 'name' => 'tbLozinkaPonovo', 
                 'class' => 'form-control', 
                 'value'=> isset($uneti_podaci['tbLozinkaPonovo'])? $uneti_podaci['tbLozinkaPonovo'] : ''
             );
                                                         $this->data['btnEmail']= array(
                 'id' => 'tbEmail', 
                 'name' => 'tbEmail', 
                 'class' => 'form-control', 
                 'value'=> isset($uneti_podaci['tbEmail'])? $uneti_podaci['tbEmail'] : ''
             );
             $this->data['btnUnesi'] = array(
                 'id' => 'btnUnesi', 
                 'name' => 'btnUnesi', 
                 'value' => 'Unesi', 
                 'class' => 'btn btn-danger'
             );
             
             $this->load->model('modelkorisnik','korisnik');
         
             $korisnici=$this->korisnik->prikazisve();
             $this->load->library('table');
             $this->table->set_template(array('table_open'=>'<table class="table" border="1">'));
             $this->table->set_heading('ID','Korisnicko ime','Vreme_registracije','uloga','Izmeni','Obrisi');
             $br=1;
           foreach($korisnici as $korisnik)
             {
                 // $id = $uloga->id;
                 $korisnickoime = $korisnik->korisnicko_ime;
          
                $vreme=$korisnik->datum_registracije;
                  $uloga=$korisnik->id_uloga;
                  $link_edit=anchor('administracija/izmeni/korisnici/'.$korisnik->id_korisnik,'Izmeni');
                 $link_delete=anchor('administracija/brisanje/korisnici/'.$korisnik->id_korisnik, 'Obrisi', array('class'=>'brisanje', 'data-idkorisnik'=>$korisnik->id_korisnik));
                 $this->table->add_row($br++, $korisnickoime,$vreme, $uloga,$link_edit, $link_delete);
                 
             }
             $this->data['korisnici']=$this->table->generate();
             $this->load->view('uloge', $this->data);
            
      

    }
     
        $this->load->view('footer');
        
    }
    
    function proveraUloge($unos) // 'callback_' + proveraUloge je naziv f-je. U promenljivoj '$unos' se nalazi ono sto korisnik unese
    {
        if($unos=="0")
        {
            return false;
        }
        return true;
    }
    
    function proveraKorIme($unos)
    {
        $regex = "/^\w{3,20}$/";
        if(!preg_match($regex,$unos))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function izmeni($tip = null, $id = null)
    {
        // akcija za izmenu bilo kog entiteta iz baze
        // primer poziva funkcije: Administracija/izmeni/korisnici/1 - $tip = 'korisnici', $id = 1
    
        $this->load->view('head');
        $is_post=$this->input->server('REQUEST_METHOD') == 'POST';
        
        
            if($tip!=null && $id!=null && $tip=="serije"){
	
                   $this->load->model('model_serije');
                      $this->model_serije->id = $id;
            $serija= $this->model_serije->podaci();
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
$opis_serije=$this->input->post("tbTekst");


$this->load->model("model_serije");

$this->model_serije->naziv=$naziv_serije;
$this->model_serije->opis=$opis_serije;
$this->model_serije->slika="images/".$file_name;
   
                     $this->form_validation->set_rules('tbNaslov','Naziv serije','trim|required');
                     $this->form_validation->set_rules('taTekst','Opis','trim|required');
                     
                 
                     
                    if (empty($_FILES['tbSlike']['name']))
{
    $this->form_validation->set_rules('tbSlike', 'Slika', 'required');
}
              
                     if($this->form_validation->run())
                     {
                     
                      $id=$this->uri->segment(4);
                      $this->model_serije->$id;
$this->model_serije->upisiSeriju();

  
                         $this->podaci['obavestenje'] = "Podaci su uneti u bazu!";
                  
}

             }}
          $this->load->view('admin/serije');
        
             }
  
     
             $this->load->view("footer");
         
    

if($tip!=null && $id!=null && $tip=="korisnici"){
             
             
             if($is_post) 
            {
                // UPDATE ULOGA
                //podaci su dosli sa forme uradi update
                $dugme = $this->input->post('btnUnesi');
                if(!empty($dugme))
                {
             $korisnicko_ime = $this->input->post('tbKorIme');
                     $lozinka = $this->input->post('tbLozinka');
                     $lozinkaponovo = $this->input->post('tbLozinkaPonovo');
                     $email = $this->input->post('tbEmail');
           $this->load->model('modelkorisnik','korisnik');
                    $this->korisnik->id_korisnik = $id;
                    $this->korisnik->korisnicko_ime = $korisnicko_ime;
                          $this->korisnik->lozinka= $lozinka;
                                $this->korisnik->email = $email;
                          $this->korisnik->izmeni();
    redirect('administracija/unesi/korisnici');
                }
            }         
              $this->load->model('modelkorisnik','korisnici');
                $this->korisnici->id_korisnik = $id;
                $korisnik = $this->korisnici->podaci();
            
            $this->data['btnKorIme']= array(
                 'id' => 'tbKorIme', 
                 'name' => 'tbKorIme', 
                 'class' => 'form-control', 
                  'value'=> $korisnik['korisnicko_ime']
             ); 
                                  $this->data['btnLozinka']= array(
                 'id' => 'tbLozinka', 
                 'name' => 'tbLozinka', 
                 'class' => 'form-control', 
                'value'=> $korisnik['lozinka']
             ); 
                                                     
                                                         $this->data['btnEmail']= array(
                 'id' => 'tbEmail', 
                 'name' => 'tbEmail', 
                 'class' => 'form-control', 
     'value'=> $korisnik['email']
             );
             $this->data['btnUnesi'] = array(
                 'id' => 'btnUnesi', 
                 'name' => 'btnUnesi', 
                 'value' => 'Unesi', 
                 'class' => 'btn btn-danger'
             );
                $this->data['korisnik'] = $korisnik; 
           
               $this->load->view('uloge', $this->data);  
         }
           
         
             
                     
        $this->load->view('footer');
}
      
        
       
        
          
       
   
    
    
    public function brisanje($tip = null, $id = null)
    {
        // akcija za brisanje bilo kog entiteta iz baze
        // primer poziva funkcije: Administracija/izmeni/korisnici/1 - $tip = 'korisnici', $id = 1
 
       if($tip!=null && $tip=='anketa'){
             if($is_post)
                     {
                    $dugme = $this->input->post('btnUnesi');
           if($dugme!=""){
               
            $tekst=$this->input->post("taTekst");
       
                  $this->load->model('modelanketa','anketa');
                  $this->anketa->tekst=$tekst;
                  $this->anketa->upisiAnketu();
           }
            
    
                 
             }
            
            
                 $this->load->model('modelanketa','anketa');
             $ankete=$this->anketa->sveAnkete();
             $this->load->library('table');
             $this->table->set_template(array('table_open'=>'<table class="table" border="1">'));
             $this->table->set_heading('ID','Tekst','Obrisi');
             $br=1;
           foreach($ankete as $anketa)
             {
                 // $id = $uloga->id;
                 $id = $anketa->id_anketa;
          $tekst=$anketa->tekst;
                
              
                 $link_delete=anchor('administracija/brisanje/anketa/'.$anketa->id_anketa,'Obrisi');
                 $this->table->add_row($id,$tekst, $link_delete);
                 
             }
             $this->data['tabela']=$this->table->generate();
             $this->load->view('admin/anketa', $this->data);
             $this->load->view("footer");
           
         }
           if($tip!=null && $id!=null && $tip=="anketa")
        {
            // DELETE ULOGA
            $this->load->model('modelanketa');
            $this->modelanketa->id_anketa=$id;
            $this->modelanketa->izbrisiAnketu();
            redirect('administracija/unesi/anketa');
            //$this->load->view('admin/uloge');
            
        }  
        if($tip!=null && $id!=null && $tip=="uloge")
        {
            // DELETE ULOGA
            $this->load->model('modeluloge','uloga');
            $this->uloga->id=$id;
            $this->uloga->obrisi();
            redirect('administracija/unesi/uloge');
            //$this->load->view('admin/uloge');
        }
          if($tip!=null && $id!=null && $tip=="serije")
        {
            // DELETE ULOGA
            $this->load->model('model_serije');
            $this->model_serije->id=$id;
            $this->model_serije->obrisi();
            redirect('administracija/unesi/serije');
            //$this->load->view('admin/uloge');
        }
          if($tip!=null && $id!=null && $tip=="galerija")
        {
            // DELETE ULOGA
            $this->load->model('model_slike');
            $this->model_slike->id=$id;
            $this->model_slike->obrisi();
            redirect('administracija/unesi/galerija');
            //$this->load->view('admin/uloge');
        }
        
        
          if($tip!=null && $id!=null && $tip=="korisnici")
        {
               $this->load->model('modelkorisnik');
              
          
            $this->modelkorisnik->id_korisnik = $id;
            $korisnici = $this->modelkorisnik->prikaziJednog();
            // brisanje slika iz tabele slika , gde se nalaze putanje do slika, i brisanje slike sa servera
            foreach ($korisnici as $korisnik1)
            {
             
                $this->modelkorisnik->id_korisnik = $korisnik1->id_korisnik;
                $this->modelkorisnik->obrisi();
            }
                


             
             
             
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
             $korisnik = $this->modelkorisnik->lista();
             $this->table->set_heading('Id','Username','Password','Email','Obrisi');
       
             $br = 1;
             foreach($korisnik as $serija)
             {
                 // $id = $uloga->id;
                 $naziv = $serija->id_korisnik;
                 $opis=$serija->korisnicko_ime;
                $email=$serija->email;
                 
 $link_delete = anchor('administracija/brisanje/korisnici/'.$serija->id_korisnik, 'Obrisi', array('class'=>'brisanje', 'data-idkorisnik'=>$serija->id_korisnik));
                 $this->table->add_row($br++, $naziv,$opis,$email, $link_delete);
                 
             }
    $this->data['korisnici'] = $this->table->generate();
             $this->load->view('ajax_korisnici', $this->data);
        }
        }
    public function izmeniSeriju(){
      
     
              $this->load->view('head');
              $id= $this->uri->segment(4);
             
                   $this->load->model('model_meni');
        $this->podaci['menus']=$this->model_meni->prikazi();
           $this->load->view('navigacija',$this->podaci);
             $is_post=$this->input->server('REQUEST_METHOD') == 'POST'; 
             
          
        $this->load->library('form_validation');
		
        
                    
                    
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
$opis_serije=$this->input->post("tbTekst");


$this->load->model("model_serije");


$this->model_serije->naziv=$naziv_serije;
$this->model_serije->opis=$opis_serije;
$this->model_serije->slika=$file_name;
   
                     $this->form_validation->set_rules('tbNaslov','Naziv serije','trim|required');
                     $this->form_validation->set_rules('taTekst','Opis','trim|required');
                     
                 
                     
                    if (empty($_FILES['tbSlike']['name']))
{
    $this->form_validation->set_rules('tbSlike', 'Slika', 'required');
}
              
                     if($this->form_validation->run())
                     {
                   
                        
$this->model_serije->upisiSeriju();

  
                         $this->podaci['obavestenje'] = "Podaci su uneti u bazu!";
                  
}
             }
          
        
             }
  
             $this->load->view('admin/serije', $this->data);
             
             $this->load->view("footer");
         }
        
        
       
    public function download()
    {
        $this->load->helper('download');
         $this->load->helper('file');
         $data = file_get_contents("images/dokumentacija.pdf");
         $name = "dokumentacija.pdf";
         force_download($name,$data);
    }
    
} 
    

