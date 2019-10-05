<?php namespace Daos;

    use Daos\DataBaseConection as DBConection;
    use Model\Type as type;

    class TypeDao extends SingletonDao implements IDao{

        private $pdo;
        protected $table = 'types';
        protected function __construct() {
            $this->pdo = DBConection::getInstance();
        }

        public function Insert($object) {
            
            try {
            $stmt = $this->pdo->Prepare("INSERT INTO ".$this->table." (type) values (?)");
            $stmt->execute(array(
                $object->getType()
            ));
            $object->setIdtype($this->pdo->LastInsertId());
            return $object;
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function Delete($object) {
            try {
            $stmt = $this->pdo->Prepare("DELETE FROM ".$this->table." WHERE idtype = ?");
            return ($stmt->execute(array($object->getIdType())));
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByID($id) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where idtype = ? LIMIT 1");
            if ($stmt->execute(array($id))) {
                if ($result = $stmt->fetch()) {
                $type = new Type(
                    $result['type']
                );
                $type->setIdType($result['idtype']);
                return $type;
                }
            }
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByType($givenType) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where type = ? LIMIT 1");
            
            if ($stmt->execute(array($givenType))) {
                if ($result = $stmt->fetch()) {
                $type = new Type(
                    $result['type']
                );
                $type->setIdType($result['idtype']);
                return $type;
                }
            }
            } catch (\PDOException $e) {
            throw $e;
            }
        }
         
        public function SelectAll() {
            try {
              $list = array();
              $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table."");
              if ($stmt->execute()) {
                while ($result = $stmt->fetch()) {
                  $typeList = new Type(
                    $result['type']);
                  $typeList->setId($result['idtype']);
                  array_push($list, $typeList);
                }
                return $list;
              }
            } catch (\PDOException $e) {
              throw $e;
            }
          }


        public function Update($object) {
            try {
            $stmt = $this->pdo->Prepare("UPDATE ".$this->table." SET type = ? WHERE idtype = ?");
            $stmt->execute(array(
                $object->getType(),
                $object->getIdType()
            ));
            return $object;
            } catch (\PDOException $e) {
            throw $e;
            }
         }


    }
?>