 <?php   echo' <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                  <img class="navbar-brand" src="'.base_url().'images/admin.ico" />
                <h1 class="page-header">Administracija
                 
                </h1>
            
        </div>';
   
         ?>
<div class="row">
            <div class="col-md-7">
           <h1 class="page-header">
                     <div class="col-md-8"> 
                <?php
               
                    if(isset($linkovi))
                    {
                        // morate ukljuciti helper 'html'
                        echo ul($linkovi); 
                    }
                ?>
                       
            </div>
            </div>
        </div>

               