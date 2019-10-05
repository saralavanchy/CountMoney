<?php namespace Model;

class Type{

    private $idType;
    private $type;

    public function __construct($type){
        $this->setType($type);
    }

    public function setType($value){
        $this->type = $value;
    }
    public function getType(){
        return $this->type;
    }
    
    public function setIdType($value){
        $this->idType = $value;
    }
    public function getIdType(){
        return $this->idType;
    }
}
?>