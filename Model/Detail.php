<?php namespace Model;

class Detail{

    private $idDetail;
    private $detail;

    public function __construct($detail){
        $this->setDetail($detail);
    }

    public function setDetail($value){
        $this->detail = $value;
    }
    public function getDetail(){
        return $this->detail;
    }
    
    public function setIdDetail($value){
        $this->idDetail = $value;
    }
    public function getIdDetail(){
        return $this->idDetail;
    }
}
?>