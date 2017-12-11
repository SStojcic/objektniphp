 <?php
      
echo'
<div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                  <img class="navbar-brand" src="'.base_url().'images/registracija.png" />
                <h1 class="page-header">Registracija
               
                </h1>
            </div>
        </div>
        '; ?>
<!-- /.row -->

        <hr>
<div class="row">
            
            <div class="col-md-5">
              
                <?php 
             
                    print validation_errors("<div class='alert alert-danger'>","</div>");
                    if(isset($obavestenje))
                    {
                        echo "<div class='alert alert-success'>".$obavestenje."</div>";
                    }?>
                <?php
                    /* 
                     * 5. Realizovati neophodne formulare u okviru spomenutih sekcija isklučivo
                     * putem odgovarajućih helper-a. Formulari se realizuju isključivo na osnovu 
                     * strukture baze podataka koja je rađena na početnim terminima vežbi. 
                     */
               
                  echo form_open('registracija',array('id'=>'forma','name'=>'forma','class'=>'form-horizontal','method'=>'POST'));
                            echo form_label('Korisnicko ime:','tbKorIme'); // 2. parametar f-je je id polja na koje se odnosi labela
                            echo form_input(array('id'=>'tbKorIme','name'=>'tbKorIme', 'class'=>'form-control'));
                            echo form_label('Lozinka:','tbLozinka');
                            echo form_password(array('id'=>'tbLozinka','name'=>'tbLozinka','class'=>'form-control'));
                            echo form_label('Lozinka ponovo:','tbLozinkaPonovo');
                            echo form_password(array('id'=>'tbLozinkaPonovo','name'=>'tbLozinkaPonovo','class'=>'form-control'));
                               echo form_label('Email:','tbEmail'); // 2. parametar f-je je id polja na koje se odnosi labela
                            echo form_input(array('id'=>'tbEmail','name'=>'tbEmail', 'class'=>'form-control'));
                         
                    echo br(); // f-ja HTML Helper-a!
                    echo form_submit(array("id"=>"btnUnesi","name"=>"btnUnesi",'class'=>"btn btn-primary", 'value'=>"Unesi"));
                    echo form_close();
                    echo "</div>"
                    
                ?>
            </div>
        
<br>
<br>
<hr>