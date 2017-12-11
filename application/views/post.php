<?php 
echo'
<div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                  <img class="navbar-brand" src="'.base_url().'images/clipart.png" />'?>
                <h1 class="page-header">Serije
                    <small>Preporuke</small>
                    
                    <h2 class="quotes">Dobrodošli!</h2>
               <h2 class="quotes">Da biste dodali seriju, morate biti registrovani!</h2>       
                </h1>
            </div>
        </div>
       <?php

  foreach($results as $data){
        
    
  echo'
<div class="row">
            <div class="col-md-7">
                <a href="#">
                    <img class="img-responsive" src="'.base_url().'images/'.$data->slika.'" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3>'.$data->naziv.'</h3>
               
                <p>'.$data->opis.'</p>
             
            </div>
        </div>
<hr>';
  
} ?>