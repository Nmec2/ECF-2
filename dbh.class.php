<?php 
    class Dbh {
        private $host = "localhost";
        private $dbname = "imagine";
        private $dbusername = "root";
        private $dbpassword = "";
        private $bdd = null;

        private function connect() {
            try {
                $this->bdd = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbusername, $this->dbpassword);
                $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed, better luck next time: " . $e->getMessage());
            }
        }

        public function getConnection() {
            if ($this->bdd === null) {
                $this->connect();
            }
            return $this->bdd;
        }
    }