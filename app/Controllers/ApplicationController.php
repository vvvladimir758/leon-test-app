<?php 
namespace App\Controllers;

use App\Models\AppModel;



class ApplicationController extends BaseController {
    
    
    
    
    
    
    public function run(){
      
       $this->router->run(); 
          
      
    }
    
    
    
    public function main($toJSON = false){
    
        $this->appSessions();
              
        $data = AppModel::getTableData($this->params);
        
        $page = (int)$this->params[0];
        
        $orderType = 'desc';
        
        if(isset($this->params[2])){
            $orderType = $this->params[2];
        }
        
        $pageCount = AppModel::pageCount();
   
        
        
        if($toJSON){
            
            $callback  = function($item){
                $_arr = $item->as_array();
                
                foreach ($_arr as $key=> $val){
                    if(empty($val)){
                        $_arr[$key]='-';
                    }
 
                }
                
                return $_arr;
                
            };
            
            $data = array_map($callback, $data);
          
            echo json_encode($data);
            return;
        }
        
        $this->render('table', compact('data','page','pageCount','orderType'));
     
    }
    
    public function mainJSON(){
        return $this->main(true);
    }
    
    public function mainVue(){
        $page = (int)$this->params[0];
        $pageCount = AppModel::pageCount();
        $this->render('vue_table', compact('pageCount','page'));
    }
    
    private function appSessions(){
        
        if(isset($this->params[1]) && isset($this->params[2])){
            $_SESSION['sortFields'] = [
                'column' =>$this->params[1],
                'order_type'=>$this->params[2]
            ];
            
        }
        else{
            
            if(isset($_SESSION['sortFields'])){
                
                $this->params[1] = $_SESSION['sortFields']['column'];
                $this->params[2] = $_SESSION['sortFields']['order_type'];
                
            }
            
        }
        return;
    }
    
    
    public function page404(){
        
        echo " Страница сгенерирована скриптом 404";
        exit();
    }
    
    
    
    
}