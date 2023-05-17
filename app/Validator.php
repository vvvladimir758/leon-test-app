<?php 
namespace App;


trait Validator{
    
    
    
    
    
    public function validateEmail($field) {
        
      
        
        if(str_contains($field, "@")){
            $domain = explode("@",$field);
          
            if(isset($domain[1]) && str_contains($domain[1],'.')){
                return true;
            }
        }
        
        return false;
    }
    
    public function validateName($field) {

        if(strlen($field)<3){
        return false;
        }
        
        if(strlen($field)>15){
            return false;
        }
        
        return true;
        
    }
    
    public function validateText($field) {
        
        if(strlen($field)<3){
            return false;
        }
      
        
        return true;
        
    }
    
    
    
    
}

