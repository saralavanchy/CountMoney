<?php namespace Controller;

    use Model\User as user;
    use Model\Movement as movement;
    use Daos\MovementDao as movementDao;
    use Controller\MovementsController as movementsController;

    class MainPageController{

        private $movementsController; 
        private $movementDao;

        public function __construct(){
            $this->movementDao = movementDao::getInstance(); 
            $this->movementsController = movementsController::getInstance();
        }

        public function Index() {
            global $movements;
            $movements = $this->movementsController->getMovements();  
            include_once 'Views/MainPage.php';
        }

    
    }

 
?>