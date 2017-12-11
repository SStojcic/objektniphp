<div class='container'>


              
             <div class='galerija'>
       

 <?php print form_open_multipart('galerija/index'); ?>
<label>Slika:</label>
                    <?php print form_upload(array('id' => 'tbSlike', 'name' => 'tbSlike')); ?>
                    </br>
                    <label>    <?php print form_submit(array('id' => 'btnUnesi', 'name' => 'btnUnesi', 'value' => 'Unesi', 'class' => 'btn btn-default')) ?>
           
                 </label>     <?php print form_close(); ?>

             <?php        foreach($slike as $slika){
        
    
  echo'
<a class="example-image-link" href="'.base_url().'images/'.$slika->naziv_galerije.'" data-lightbox="example-set" >
	  <img class="img-responsive1" src="'.base_url().'images/'.$slika->male_slike.'" alt=""/></a>';
               
           
         

  
} ?>
                   <?php echo" <script src='".base_url()."js/lightbox-plus-jquery.min.js'></script> ";?>
         </div> 
