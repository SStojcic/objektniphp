<body>
            
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         
        <div class="container1">
            <!-- Brand and toggle get grouped for better mobile display -->
 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar">
                     
                    </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
             
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
           <?php 
    
        if(isset($menus)){
            foreach ($menus as $menu){
                
  echo "<li><a href='". base_url().$menu->putanja."'>".$menu->naslov_meni."</a></li>";              
      
                
            }
      
        } 
        
        ?>
   
              <li><a href="images/dokumentacija.pdf"target="_blank" >Dokumentacija</a></li>    
   
   <?php
   
         $sesija=$this->session->userdata('ulogovan');
                if(!empty($sesija)){
                    //ulogovan
                
                    $linkovi = array(
                        
                        anchor('Logovanje/logout','Logout')
                    );
                    
                    echo ul($linkovi, array('class'=>'nav navbar-nav'));
              }
              
               if($this->session->userdata('uloga') == 'admin')
                   {   $linkovi = array(
                         
                        anchor('administracija','Administracija')
                    );
                    
                    echo ul($linkovi, array('class'=>'nav navbar-nav'));
                 
              }
                   
                   
               if($this->session->userdata('uloga') == 'korisnik')
                   {   $linkovi = array(
                        
                        anchor('korisnik','Profil')
                      
                    );
                    
                    echo ul($linkovi, array('class'=>'nav navbar-nav'));
                 
              }
                   
                   
                   
               
              else {
                  $linkovi=array('');
                  
                     echo ul($linkovi, array('class'=>'nav navbar-nav')); 
              }   
              
           
    ?> 
                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

     <div class="well">
                    
                    <?php
                       if(empty($sesija)){
                    /* 
                         * 3.  Sa desne strane u delu Side Widget Well kreirati formu za logovanje 
                         * isključivo pomoću odgovarajućih helper-a. Vrednost atributa action forme
                         *  treba da je Logovanje/login . 
                     */
               
                        // morate ukljuciti helper 'form'
                     
                       echo'    <h4>Login</h4>';
                       $this->load->helper('form');
                    /* 
                         * 3.  Sa desne strane u delu Side Widget Well kreirati formu za logovanje 
                         * isključivo pomoću odgovarajućih helper-a. Vrednost atributa action forme
                         *  treba da je Logovanje/login . 
                     */
    print validation_errors("<div class='alert alert-danger'>","</div>");
                    if(isset($obavestenje))
                    {
                        echo "<div class='alert alert-success'>".$obavestenje."</div>";
                    }?>
                       
                       <?php
                            echo form_open('Logovanje/login',array('id'=>'forma','name'=>'forma','class'=>'form-horizontal','method'=>'POST'));
                            echo form_label('Korisnicko ime:','tbKorIme'); // 2. parametar f-je je id polja na koje se odnosi labela
                            echo form_input(array('id'=>'tbKorIme','name'=>'tbKorIme', 'class'=>'form-control'));
                            echo form_label('Lozinka:','tbLozinka');
                            echo form_password(array('id'=>'tbLozinka','name'=>'tbLozinka','class'=>'form-control'));
                            echo form_submit(array('id'=>'btnLogovanje','name'=>'btnLogovanje','class'=>'btn btn-danger', 'value'=>'Uloguj se'));
                            echo form_close();
                    
                    
                       }         
                       else{
                           $username=$this->session->userdata('korisnicko_ime');
                           echo "Ulogovani ste kao: ".$username;
                       }
                       ?>
                </div>

