<?php namespace Utils;

use Model\User as user;
use Model\Movement as movement;
use Daos\MovementDao as movementDao; 

class CommonUtils{

    private static $instance = null;

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance= new self();
        }
        return self::$instance;
    }

    public function __construct(){
        $this->movementDao = movementDao::getInstance(); 
    }

   
}

?>