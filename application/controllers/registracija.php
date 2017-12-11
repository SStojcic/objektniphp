<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registracija
 *
 * @author stefan
 */
class registracija extends CI_Controller{
  private $podaci=array();
  private $pod=array();
  public function __construct() {
      parent::__construct();
  
      
        
       $this->load->model("loginmodel");
$this->load->model('model_meni');
       }
    
    
    public function index(){
        
        $this->load->view('head');
       // prosledjivanje podataka ka View-u
                   

        $this->podaci['menus']=$this->model_meni->prikazi();
        $this->load->view('navigacija',$this->podaci);
      
        $uneti_podaci = array();
      
                 $dugme = $this->input->post('btnUnesi');
                 
                 if($dugme!="")
                 {
                     $korisnicko_ime = $this->input->post('tbKorIme');
                     $lozinka = $this->input->post('tbLozinka');
                     $lozinkaPonovo = $this->input->post('tbLozinkaPonovo');
                     $email = $this->input->post('tbEmail');
                      $this->load->model("loginmodel",'korisnici');
                       $this->korisnici->korisnicko_ime=$korisnicko_ime;
$this->korisnici->lozinka=$lozinka;
$this->korisnici->email=$email;

                    
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
                     
                        $this->korisnici->registracija();
               
  
                         $this->data['obavestenje'] = "Podaci su uneti u bazu!";
                     }
                  
                 }

        
      
        $this->load->view("registracija");
      
        $this->load->view('footer');
 
            
   
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
         }
}
