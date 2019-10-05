<?php namespace Controller;

use Model\User as User;
use Daos\UserDao as UserDao;

class LoginController {

    private $userDao;

    public function __construct() {
      $this->userDao = UserDao::getInstance();  
    }

    public function Index($mensaje = "") {
      $msj=$mensaje;
      require_once 'Views/Login.php';
      }
    
    private function Login($user) {
      $_SESSION['user'] = $user;
      header('location: /'.BASE_URL.'MainPage');
   
    }

    public function Logout(){
      session_destroy();
      header('location: /'.BASE_URL.'login');
    }
    
    public function LoginProcess($username, $password){
        $user=null;
        try{
          $user = $this->userDao->SelectByUsername($username);
          if(is_null($user)){
           
            $user = $this->userDao->SelectByEmail($username);
          }
          if(!is_null($user)){
            if($user->getPassword() == $password){
              $this->Login($user);
            }else{
              $this->Index("your password is incorrect");
            }
          }else{
            $this->Index("your user doesn't exist");
          }   

        } catch(\Exception $e){
          $this->Index("Conection Fail, try again later");
        }

    }
    
}
?>