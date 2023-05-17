<?php 
namespace App\Models;

use Config\DatabaseConfig;
use j4mie\idiorm;

class BaseModel{
    
    protected static $table;
    
    static function getTable(){
        return static::$table ;
    }
    
}

?>