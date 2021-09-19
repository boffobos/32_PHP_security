<?php 
    class Database {
        private $db;
        private $stmt;
        private $error;
        public function __construct()
        {   //new instanse of db
            $dsn = DB_TYPE . DB_HOST . 'dbname=' . DB_NAME ; 
            try {
            $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        public function prepare($sql){
            $this->stmt = $this->db->prepare($sql);
        }

        public function query($sql){
            $this->stmt = $this->db->query($sql);
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function bind($pseudo, $value,  $type = null){
            switch(true){
                case is_int($value):
                  $type = PDO::PARAM_INT;
                  break;
                case is_bool($value):
                  $type = PDO::PARAM_BOOL;
                  break;
                case is_null($value):
                  $type = PDO::PARAM_NULL;
                  break;
                default:
                  $type = PDO::PARAM_STR;
              }
            $this->stmt->bindParam($pseudo, $value, $type);
        }

        public function execute(){
            return $this->stmt->execute();
        }

        public function selectAll(){
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectRow(){
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }