<?php 
namespace App\Models;


class AppModel extends BaseModel{
    
    protected static $pageLimit = 10;
    protected static $table = 'Country';
    
   
    
    
    public static function getTableData($params){
       
     
      
        if(!empty($params[1]) && !empty($params[2]) ){
            list($page,$column,$type) = [$params[0],$params[1],$params[2]];
        }
        else{
            list($page,$column,$type) = ['0','Continent','desc'];
        }
        
        if(isset($params[0]) && $params[0]>0 ) {
            $page = (int)$params[0]-1;
           
        }
        else{
            $page = 0;
        }
        
        $offset = $page*self::$pageLimit;
        
        $order =  $type =='desc' ? 'DESC' : 'ASC' ;
        
        if(!self::filterColumn($column)){
            $column = 'Continent';
        }
        
   
      
        $data = \ORM::for_table(self::getTable())
        ->raw_query('   SELECT cn.`Region`, cn.`Continent`,  COUNT(cn.`Name`) AS `Countries`,
        ROUND(AVG(cn.`LifeExpectancy`),2) AS `LifeDuration`, 
        SUM(ct.`Cities`) AS `Cities`,
        SUM(cl.`Languages`) As `Languages`, 
        ROUND(SUM(cn.`Population`),0) AS `Population` 
            FROM `Country` cn 
        LEFT JOIN ( SELECT `CountryCode`, COUNT(`Name`) AS `Cities` FROM `City` GROUP BY `CountryCode` ) ct ON ct.`CountryCode` = cn.`Code` 
            LEFT JOIN ( SELECT `CountryCode`, COUNT(`Language`) AS `Languages` FROM `CountryLanguage` GROUP BY `CountryCode` ) cl ON cl.`CountryCode` = cn.`Code` 
                GROUP BY cn.`Region`,cn.`Continent` 
  ORDER BY '.$column.' '.$order.'
 LIMIT :limit 
OFFSET :offset 
',  
 array('limit'=>self::$pageLimit,'offset'=>$offset)
 )
                ->find_many();
        
       return $data;

    }
    
    private static function filterColumn($column){
        
     $allowedNames = array('Continent','Region','Countries','LifeDuration','Population','Cities','Languages');
     if(in_array($column, $allowedNames))
     {
         return true;
     }
     return false;
    }
    

    
    public static function pageCount(){
        $data = \ORM::for_table(self::getTable())
        ->raw_query(' SELECT cn.`Region`, cn.`Continent`,  COUNT(cn.`Name`) AS `Countries` 
FROM `Country` cn 
     GROUP BY cn.`Region`,cn.`Continent`')
        ->find_many();

        return range(1,(ceil(count($data)/self::$pageLimit)));
        
    }
    
    public static function getTaskData($id){
        
        $task = \ORM::for_table(self::getTable())
        ->where(self::getTable().'.id',$id)
        ->join('users', array(self::getTable().'.user_id', '=', 'users.id'))
        ->find_one();
        
        $data= [
            'userId'=>$task->user_id,
            'name'=>$task->name,
            'email'=>$task->email,
            'descripition'=>$task->descripition,
            'status'=>$task->status
        ];
        
        return $data;
        
    }
    
    public static function store($data){
        
        $userId = UserModel::create($data);
        
        $task = \ORM::for_table('tasks')->create();
        $task->user_id = $userId;
        $task->descripition = $data['descripition'];
        $task->status = 0;
        $task->save();
        
        return true;
    }
    
    public static function update($data){
        
        
        $task = \ORM::for_table('tasks')->find_one($data['id']);
        $task->user_id = $data['userId'];
        $task->descripition = $data['descripition'];
        $task->status = $data['status'];
        $task->save();
        
        return true;
    }
    
    
    
    
}