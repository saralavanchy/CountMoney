<?php namespace Controller;

use Daos\DetailDao as detailDao;

class DetailController{

    private $detailDao;
    private static $instance = null;

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance= new self();
        }
        return self::$instance;
    }

    public function __construct(){
        $this->detailDao = detailDao::getInstance();
    }

    public function Index(){}
    
    public function collectDetail()
    {
        $detailList = null;
        try{
            $detailList=$this->detailDao->SelectAll();
        }catch(\Exception $e){
            $this->Index("Conection Fail, try again later");
        }
        return $detailList;   
    }

}

?>