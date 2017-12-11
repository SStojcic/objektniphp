  <?php
echo'<div class="container">';?>
        

       
      
  

<div class="row">
            <div class="col-md-7">
           <h1 class="page-header">
                  Vas profil
                    <small>sekcija za administraciju</small>
                </h1>
            <?php
                $username=$this->session->userdata('korisnicko_ime');
                   $email=$this->session->userdata('email');        
                    
              echo'<h1> Vas profil: <h1>';
                echo "<h2>Korisnicko ime: ".$username."</h2>";
                             echo "<h2>Email: ".$email."</h2></br></br>";
                
                             echo "<h3>Ovde mozete videti i obrisati svoje postove";
                             echo'<br>';
                           ?>
                
                 <?php if(isset($tabela_korisnik)) print $tabela_korisnik; ?>
       
            </div>
        </div>
<hr>';
                
     