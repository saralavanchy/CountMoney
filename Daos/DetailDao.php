<?php namespace Daos;

    use Daos\DataBaseConection as DBConection;
    use Model\Detail as Detail;

    class DetailDao extends SingletonDao implements IDao{

        private $pdo;
        protected $table = 'details';
        protected function __construct() {
            $this->pdo = DBConection::getInstance();
        }

        public function Insert($object) {
            
            try {
            $stmt = $this->pdo->Prepare("INSERT INTO ".$this->table." (detail) values (?)");
            $stmt->execute(array(
                $object->getDetail()
            ));
            $object->setIdDetail($this->pdo->LastInsertId());
            return $object;
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function Delete($object) {
            try {
            $stmt = $this->pdo->Prepare("DELETE FROM ".$this->table." WHERE iddetail = ?");
            return ($stmt->execute(array($object->getIdDetail())));
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByID($id) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where iddetail = ? LIMIT 1");
            if ($stmt->execute(array($id))) {
                if ($result = $stmt->fetch()) {
                $detail = new Detail(
                    $result['detail']
                );
                $detail->setIdDetail($result['iddetail']);
                return $detail;
                }
            }
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByDetail($givendetail) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where detail = ? LIMIT 1");
            
            if ($stmt->execute(array($givendetail))) {
                if ($result = $stmt->fetch()) {
                $detail = new Detail(
                    $result['detail']
                );
                $detail->setIdDetail($result['iddetail']);
                return $detail;
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
                  $detailList = new Detail(
                    $result['detail']);
                  $detailList->setIdDetail($result['iddetail']);
                  array_push($list, $detailList);
                }
                return $list;
              }
            } catch (\PDOException $e) {
              throw $e;
            }
          }


        public function Update($object) {
            try {
            $stmt = $this->pdo->Prepare("UPDATE ".$this->table." SET detail = ? WHERE iddetail = ?");
            $stmt->execute(array(
                $object->getDetail(),
                $object->getIdDetail()
            ));
            return $object;
            } catch (\PDOException $e) {
            throw $e;
            }
         }


    }
?>