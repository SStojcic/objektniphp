


        

           <?php
echo'<div class="container">';?>
        

       
      
  

<div class="row">
            <div class="col-md-7">
           <h1 class="page-header">
                <div class="col-md-7">
               <?php print form_open_multipart('administracija/unesi/anketa'); ?>
               
                  
                
                
                    <label>Tekst:</label>
                    <?php print form_textarea(array('id' => 'taTekst','rows'=>'5',  'name' => 'taTekst', 'class' => 'form-control')); ?>
              
                    </br>
              
                   
                
                    <label> Unesi   <?php print form_submit(array('id' => 'btnUnesi', 'name' => 'btnUnesi', 'value' => 'Unesi', 'class' => 'btn btn-default')) ?>
                    </label>     <?php print form_close(); ?>
                    <hr>
                    <?php 
                 if(isset($tabela))
                 {
                       echo $tabela;
                 } ?>
            </div>
        </div>
<hr>
      
  

           
               
