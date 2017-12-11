    <?php
echo'<div class="container">';?>
        

       
      
  

<div class="row">
            <div class="col-md-7">
           <h1 class="page-header">
                  Upravljanje serijama
                    <small>sekcija za administraciju</small>
                </h1>
                 <?php print form_open('administracija/unesi/uloge', array('onSubmit'=>'return funkcija();')); ?>
                
                <?php if(isset($tabela_uloge)) print $tabela_uloge; ?>
           
            </div>
        </div>
<hr>';
                
               