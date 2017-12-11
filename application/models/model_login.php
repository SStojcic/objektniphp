<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_login
 *
 * @author stefan
 */



class model_login extends CI_Model{
    public function __construct() {
        parent::__construct();
        
    }
    
    public function login($user,$lozinka){
        $this->db->select('user,pass,user_level');
        $this->db->from('korisnici');
        $this->db->where('user',$user);
        
        $this->db->where('pass',$lozinka);
        $query=$this->db->get();
      
      
            
            
            
        if($query->num_rows()==1){
             
        redirect('administracija');}
        else{
            return false;
        }
       
        
    
    
        }
    }


    