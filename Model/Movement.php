<?php namespace Model;

class Movement{
    
    private $idmovement;
    private $date;
    private $amount;
    private $iduser;
    private$type;
    private $detail;

    public function __construct($date, $detail, $amount, $type, $iduser){
        $this->setDate($date);
        $this->setDetail($detail);
        $this->setAmount($amount);
        $this->setType($type);
        $this->setIdUser($iduser);
    }

    public function setDate($value){
        $this->date=$value;
    }
    public function getDate(){
        return $this->date;
    }
    public function setDetail($value){
        $this->detail=$value;
    }
    public function getDetail(){
        return $this->detail;
    }
    public function setAmount($value){
        $this->amount=$value;
    }
    public function getAmount(){
        return $this->amount;
    }
    public function setType($value){
        $this->type=$value;
    }
    public function getType(){
        return $this->type;
    }
    public function setIdMovement($value){
        $this->idmovement=$value;
    }
    public function getIdMovement(){
        return $this->idmovement;
    }
    public function setIdUser($value){
        $this->iduser=$value;
    }
    public function getIdUser(){
        return $this->iduser;
    }
}
?>