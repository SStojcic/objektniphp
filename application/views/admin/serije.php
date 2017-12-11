<div class="container">
<div class="row">
            <div class="col-md-7">
           <h1 class="page-header">
                 Upravljanje serijama
                    <small>sekcija za administraciju</small>
                </h1>
          <?php 
             
                    print validation_errors("<div class='alert alert-danger'>","</div>");
                    if(isset($obavestenje))
                    {
                        echo "<div class='alert alert-success'>".$obavestenje."</div>";
                    }?>
                <table class='tablica'>    <?php print form_open_multipart('administracija/izmeniSeriju'); ?>
               
                    <label>Naziv:</label>
                    <?php print form_input(array('id' => 'tbNaslov', 'name' => 'tbNaslov', 'class' => 'form-control')); ?>
                
                
                    <label>Tekst:</label>
                    <?php print form_textarea(array('id' => 'taTekst','rows'=>'5',  'name' => 'taTekst', 'class' => 'form-control')); ?>
              
                    </br>
              
                    <label>Slika:</label>
                    <?php print form_upload(array('id' => 'tbSlike', 'name' => 'tbSlike')); ?>
                    </br>
                    <label>    <?php print form_submit(array('id' => 'btnUnesi', 'name' => 'btnUnesi', 'value' => 'Unesi', 'class' => 'btn btn-default')) ?>
                    </label>     <?php print form_close(); ?>
                </table>
                </div>
            </div>
              <div class="row">

            <div class="col-md-6 portfolio-item">
               
                    <?php 
                 if(isset($tabela))
                 {
                       echo $tabela;
                 } ?>
                </div>
                </div>