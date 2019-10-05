<?php namespace Daos;

    use Daos\DataBaseConection as DBConection;
    use Model\Movement as Movement;
    use Daos\Detail as Detail;
    use Daos\Type as type;

    class MovementDao extends SingletonDao implements IDao{

        private $pdo;
        private $detail;
        private $type;
        protected $table = 'movements';


        protected function __construct() {
            $this->detail = DetailDao::getInstance();
            $this->type = TypeDao::getInstance();    
            $this->pdo = DBConection::getInstance();
        }

        public function Insert($object) {
            try {
            $stmt = $this->pdo->Prepare("INSERT INTO ".$this->table." (date, amount, fk_iduser, fk_idtype, fk_iddetail) values (?,?,?,?,?)");
            $stmt->execute(array(
                $object->getDate(),
                $object->getAmount(),
                $object->getIdUser(),
                $object->getType(),
                $object->getDetail()
            ));
            $object->setIdMovement($this->pdo->LastInsertId());

            return $object;
            } catch (\PDOException $e) {
                throw $e;
            
            }
        }

        public function Delete($object) {
            try {
            $stmt = $this->pdo->Prepare("DELETE FROM ".$this->table." WHERE idmovements = ?");
            return ($stmt->execute(array($object->getIdMovement())));
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        //$date, $detail, $amount, $type, $iduser
        public function SelectByID($id) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where idmovements = ? LIMIT 1");
            if ($stmt->execute(array($id))) {
                if ($result = $stmt->fetch()) {
                $movement = new Movement(
                    $result['date'],
                    $result['fk_iddetail'],
                    $result['amount'],
                    $result['fk_idtype'],
                    $result['fk_iduser']
                );
                $movement->setIdMovement($result['idmovements']);
                $detail = ($this->detail->SelectById($movement->getDetail()))->getDetail();
                $type = ($this->type->SelectByID($movement->getType()))->getType();
                $movement ->setDetail($detail);
                $movement ->setType($type);
                return $movement;
                }
            }
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectAll() {
            try {
              $list = array();
              $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." ORDER BY DATE");
              if ($stmt->execute()) {
                while ($result = $stmt->fetch()) {
                    $movement = new Movement(
                        $result['date'],
                        ($this->detail->SelectById($result['fk_iddetail']))->getDetail(),
                        $result['amount'],
                        ($this->type->SelectById($result['fk_idtype']))->getType(),
                        $result['fk_iduser']
                  );
                  $movement->setIdMovement($result['idmovements']);
                  array_push($list, $movement);
                }
                return $list;
              }
            } catch (\PDOException $e) {
              throw $e;
            }
          }


        public function Update($object) { }


    }
?>