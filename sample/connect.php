<?php
    class Connect {
        public function pdo() {

            $dsn = 'mysql:dbname=my_tables;host=localhost;charset=utf8mb4';    //DBに接続
            $user = 'root';
            $password = 'ozi123';
            try { 
                $dbh = new PDO($dsn, $user, $password);     
            } catch(PDOException $e) {
                die('Connect Error: ' . $e->getCode()); 
            }
            $dbh->setATTribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $dbh;
        }
    }
?>