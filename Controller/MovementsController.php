<?php namespace Controller;

    use Model\User as user;
    use Model\Movement as movement;
    use Daos\MovementDao as movementDao;
    use Controller\detailController as detailController;

    class MovementsController{
        
        private $movementDao;
        private $detailDao;
        private $detailController;
        private static $instance = null;

        public static function getInstance(){
            if(is_null(self::$instance)){
                self::$instance= new self();
            }
            return self::$instance;
        }

        public function __construct(){
            $this->movementDao = movementDao::getInstance(); 
            $this->detailController = detailController::getInstance();
            $this->detailController =  detailController::getInstance();
        }

        public function Index($mensaje=null, $possitiveMessage = null) {
            $msj=$mensaje;
            $possitiveMsj = $possitiveMessage;
            $detail=$this->detailController->collectDetail();
            $movements = $this->getMovements();
            include_once 'Views/Movements.php';
        }

        public function addMovement($date=null, $amount=null, $type=null, $detail=null){
            if($date==null || $amount==null || $type==null || $detail==null){
                $msj="todos los campos son requeridos";
                $this->Index($msj);
            }else{
                $iduser = $_SESSION['user']->getIdUser();
                $movement = new movement($date, $detail, $amount, $type, $iduser);
                try{
                    $insertedMovement = $this->movementDao->Insert($movement);
                    if(is_null($insertedMovement->getIdMovement())){
                        $this->Index("no se ha podido cargar el movimiento, intente mas tarde", null);

                    }else{
                        $this->Index(null,"Se ha cargado el movimiento satisfactoriamente");
                    }
                    
                }catch(\Exception $e){
                    $this->Index("Conection Fail, try again later");
                }
          
            }
        }

        public function deleteMovement($idMovement=null){
            var_dump($idMovement);
            if(!isset($idMovement)){
                $this->Index("no ha seleccionado nada para eliminar");
            }else{
                echo $idMovement;
            }
        }

        public function getMovements(){
            $movements = array();
            $idUser = $_SESSION['user']->getIdUser();
            $i=0;
            $c=0;
            try{
                $allMovementsList = $this->movementDao->SelectAll();
                while($i < count($allMovementsList)){
                    if( $allMovementsList[$i]->getIdUser() == $idUser){
                        $movements[$c] =$allMovementsList[$i];
                        $c++;                    
                    }
                    $i++;
                }
            } catch (\Exception $e){
                $movements = $e->getMessage();
            }
            return $movements;
        }
    


    }