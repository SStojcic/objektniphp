<?php



class Logovanje extends CI_Controller{
   
    public function __construct() {
        parent::__construct();
   
  
 
        
    }
 public function login()
{
$dugme=$this->input->post("btnLogovanje");
$korisnicko_ime= trim($this->input->post("tbKorIme"));
$lozinka= trim($this->input->post("tbLozinka"));

if($dugme && $korisnicko_ime!="" && $lozinka!="")
{
$this->load->model('loginmodel','korisnici');
$this->korisnici->korisnicko_ime=$korisnicko_ime;
$this->korisnici->lozinka=$lozinka;

 $this->form_validation->set_rules('tbKorIme','Korisnicko ime','trim|required');
                     $this->form_validation->set_rules('tbLozinka','Lozinka','trim|required');
     $this->form_validation->set_message('required','Poje %s je prazno.');
                   
                     $this->form_validation->set_message('proveraKorIme','Polje %s nije u ispravnom formatu');
                     
                        if($this->form_validation->run())
                     {
$korisnik=$this->korisnici->login();
$this->podaci['obavestenje']="Podaci su uneti u bazu!";}


                     

$this->load->view("navigacija",$this->podaci);


if(count($korisnik)>0)
{
$uloga=$korisnik->uloga;
$id_korisnik= $korisnik->id_korisnik;
$korisnickoImeKorisnika=$korisnik->korisnicko_ime;
$email=$korisnik->email;
switch($uloga)
{
case "admin":
$newdata = array(
'id_korisnik' => $id_korisnik,
'korisnicko_ime' => $korisnickoImeKorisnika,
'uloga' => $uloga,
'email' => $email,
'ulogovan' => TRUE
);
$this->session->set_userdata($newdata);
redirect("administracija");
exit();
break;

case "korisnik":
$newdata = array(
'id_korisnik' => $id_korisnik,
'korisnicko_ime' => $korisnickoImeKorisnika,
'uloga' => $uloga,
'email' => $email,
'ulogovan' => TRUE
);
$this->session->set_userdata($newdata);
redirect("korisnik");
exit();
break;
}
}
else
{
redirect("home");
}

}
else{
    redirect();
  
}

}
    public function logout()
    {
        // kod za odjavu
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('ulogovan');
        $this->session->sess_destroy();
        redirect();
    }
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