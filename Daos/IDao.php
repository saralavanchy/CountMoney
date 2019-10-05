<?php namespace Daos;

interface Idao{
    public function Insert($object);
    public function Delete($object);
    public function SelectById($object);
    public function SelectAll();
    public function Update($object);
}

?>