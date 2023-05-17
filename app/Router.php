<?php 

namespace App;


use App\Exceptions\RouteException;

class Router{
    
    
    private static $singleton = null;
   
    public static function singleton()
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new Router();
        }
        return self::$singleton;
    }
    
    
    protected $routes= [
        'main'=>['ApplicationController','main'],
        'main_vue'=>['ApplicationController','mainVue'],
        'main_json'=>['ApplicationController','mainJSON']
 
    ];
    
 
    
    protected function getRoute(array $routeData){
        if(isset($this->routes[$routeData['name']])){
            return [$this->routes[$routeData['name']],$routeData['params']];
        }
        else{
            return false;
        }
    }
    
    protected function parseQuery(){
        if(isset($_GET['q'])){
            $routeData = explode('/',$_GET['q']);
            $routeData = [
                'name'=>$routeData[0],
                'params'=>array_slice($routeData, 1)
            ];
            
           
            return $routeData;
        }
        else 
            return  $routeData = [
                'name'=>'main',
                'params'=>[]
            ];  
        }
        
        public function get(){
            
            $routeData = $this->parseQuery();
            
                if($routeData){
                    
                    $result = $this->getRoute($routeData);
                        if($result){
                            return $result;
                        }
                        else{
                            return [$this->routes['404'],[]];
                        }
                }
                else 
                    return false;
        }
        
        
        
        public function run(){
            
            $routeData = $this->get();
            
            
            list($routeData,$params) = $routeData;
            list($controller,$method) = $routeData;
            

            
            
            $controller = "App\Controllers"."\\".$controller;
            
            try{
                
                if(class_exists($controller)){
                    
                    if(method_exists($controller, $method)){

                            $obj = new $controller($params);
                            $obj->$method();
                     
                        
                    }
                    else{
                        throw new RouteException('Метода '.$method.' нет в'.$controller);
                    }
                    
                }
                else{
                    
                    throw new RouteException('Нету такого класса:'.$controller);
                    
                }
                
            }
            catch (Exception $e) {
                
                
                
                if ($e instanceof RouteException){
                    
                    $this->log($e);
                    $this->page404();
                }
                else
                    var_dump($e);
                    
            }
            
            
            
            
        }
        
        
        public function route($name,$params=[]){
            
            $routeData = ['name'=>$name,'params'=>$params];
            $routeData = $this->getRoute($routeData);
            
            
            list($routeData,$params) = $routeData;
            list($controller,$method) = $routeData;
            
            
            
            
            $controller = "App\Controllers"."\\".$controller;
            $this->routeHandler($controller, $method, $params);
            
        }
        
        
        protected function routeHandler($controller, $method,$params){
            
            
                
            
            try{
                
                if(class_exists($controller)){
                    
                    if(method_exists($controller, $method)){
                        
                        $obj = new $controller($params);
                        $obj->$method();
                        
                        
                    }
                    else{
                        throw new RouteException('Метода '.$method.' нет в'.$controller);
                    }
                    
                }
                else{
                    
                    throw new RouteException('Нету такого класса:'.$controller);
                    
                }
                
            }
            catch (Exception $e) {
                
                
                
                if ($e instanceof RouteException){
                    
                    $this->log($e);
                    $this->route('404');
                }
                else
                    var_dump($e);
                    
            }
            
        }
        
        protected function log(){
            
            //errorLog;
        }
        
        
    
}








?>