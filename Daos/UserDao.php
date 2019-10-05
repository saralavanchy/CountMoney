<?php namespace Daos;

    use Daos\DataBaseConection as DBConection;
    use Model\User as User;

    class UserDao extends SingletonDao implements IDao{

        private $pdo;
        protected $table = 'users';
        protected function __construct() {
            $this->pdo = DBConection::getInstance();
        }

        public function Insert($object) {
            try {
            $stmt = $this->pdo->Prepare("INSERT INTO ".$this->table." (name, email, password, profileImage) values (?,?,?,?)");
            $stmt->execute(array(
                $object->getUsername(),
                $object->getEmail(),
                $object->getPassword(),
                $object->getProfileImage()
            ));
            $object->setIdUser($this->pdo->LastInsertId());
            return $object;
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function Delete($object) {
            try {
            $stmt = $this->pdo->Prepare("DELETE FROM ".$this->table." WHERE idusers = ?");
            return ($stmt->execute(array($object->getIdUser())));
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByID($id) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where id_account = ? LIMIT 1");
            if ($stmt->execute(array($id))) {
                if ($result = $stmt->fetch()) {
                $user = new User(
                    $result['name'],
                    $result['email'],
                    $result['password'],
                    $result['profileImage']
                );
                $user->setIdUser($result['idusers']);
                return $user;
                }
            }
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByUsername($username) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where name = ? LIMIT 1");
            
            if ($stmt->execute(array($username))) {
                if ($result = $stmt->fetch()) {
                $user = new User(
                    $result['name'],
                    $result['email'],
                    $result['password'],
                    $result['profileImage']
                );
                $user->setIdUser($result['idusers']);
                return $user;
                }
            }
            } catch (\PDOException $e) {
            throw $e;
            }
        }

        public function SelectByEmail($email) {
            try {
            $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where email = ? LIMIT 1");
            if ($stmt->execute(array($email))) {
                if ($result = $stmt->fetch()) {
                $user = new User(
                    $result['name'],
                    $result['email'],
                    $result['password'],
                    $result['profileImage']
                );
                $user->setIdUser($result['idusers']);
                return $user;
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
                  $account = new Account(
                    $result['name'],
                    $result['email'],
                    $result['password'],
                    $result['profileImage']
                  );
                  $account->setId($result['idusers']);
                  array_push($list, $account);
                }
                return $list;
              }
            } catch (\PDOException $e) {
              throw $e;
            }
          }


        public function Update($object) {
            try {
            $stmt = $this->pdo->Prepare("UPDATE ".$this->table." SET name = ?, email = ?, password = ?, profileimage = ? WHERE idusers = ?");
            $stmt->execute(array(
                $object->getUsername(),
                $object->getEmail(),
                $object->getPassword(),
                $object->getProfileImage(),
                $object->getUserId()
            ));
            return $object;
            } catch (\PDOException $e) {
            throw $e;
            }
         }


    }
?>