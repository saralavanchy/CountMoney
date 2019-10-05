<?php namespace Model;

class User{

    private $idUser;    
    private $username;
    private $email;
    private $password;
    private $perfilImage;

    public function __construct($username, $email, $password, $image=null){
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPerfilImage($image);
    }

    public function setIdUser($id){
        $this->idUser= $id;
    }

    public function getIdUser(){
        return $this->idUser;
    }

    public function setUsername($value){
        $this->username =$value;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setEmail($value){
        $this->email =$value;
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function setPassword($value){
        $this->password =$value;
    }

    public function getPassword(){
        return $this->password;
    }
    
    public function setPerfilImage($value){
        $this->perfilImage =$value;
    }

    public function getPerfilImage(){
        return $this->perfilImage;
    }

    public function toJson() {
  	return [
			'userId' => $this->idUser,
			'name' => $this->username,
			'email' => $this->email,
			'password' => $this->password
		];
	}
}

?>