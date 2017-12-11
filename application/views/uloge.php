  
 <div class="container">

        <div class='row'><div class='col-md-6 portfolio-item'>
                  <h1 class="naslovtekst">
              Dodavanje i prikaz korisnika
                    <small>sekcija za administraciju</small>
                </h1>
                <div id="korisnici">                   
 <?php 
             
                    print validation_errors("<div class='alert alert-danger'>","</div>");
                    if(isset($obavestenje))
                    {
                        echo "<div class='alert alert-success'>".$obavestenje."</div>";
                    }?>
              <?php 
                    if(isset($korisnik))
                    {
                        print form_open('administracija/izmeni/korisnici/'.$korisnik['id_korisnik'], array('onSubmit'=>'return funkcija();'));
                    }
                    else
                    {
                        print form_open('administracija/unesi/korisnici', array('onSubmit'=>'return funkcija();'));
                    }
                 ?>
                    <label>Korisnicko ime</label>
                    <?php print form_input($btnKorIme); ?>
                <label>Lozinka</label>
                <?php print form_password($btnLozinka); ?>
               <?php  if(!isset($korisnik)){
              echo "  <label>Lozinka ponovo</label>";
               print form_password($btnLozinkaPonovo); }?> 
                   <label>Email</label>
                    <?php print form_input($btnEmail); ?>
                            <?php print form_submit($btnUnesi); ?>
                <?php print form_close(); ?>
                 
                      
                    
                    
                   
                </div>
            </div></div>
      
                
                         <div id="prikaz_ajax">
                <?php 
                
                    if(isset($korisnici))
                    {
                        echo $korisnici;
                    }
                ?>
                </div>
             
               