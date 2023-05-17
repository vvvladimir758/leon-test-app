<?php 

namespace  Config;

use j4mie\idiorm;

class DatabaseConfig {
    

     
    
    protected static function connectDb(){ 
    \ORM::configure('mysql:host=localhost;dbname=leon_test');
    \ORM::configure('username', 'root');
    \ORM::configure('password', '');
    }
    
    public static function init(){
        
        
        self::connectDb();
        
        if(!self::checkTables())
         die('ошибка базы данных');
        
    
    }
    
    
    private static function checkTables(){
        try{
            
            $check = \ORM::for_table('Country')
            ->find_one();
        }
        catch(\PDOException $e){
           
            if($e->errorInfo[1]!= 1146){
                die($e->errorInfo[2]);
            }
            else{

                $sql = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'world.sql');
                \ORM::rawExecute($sql);
            }
            
         
        }
       return true;
    }
    
    
}



?>