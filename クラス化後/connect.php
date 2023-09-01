<?php
    class Connect {
        public function pdo() {
            //DB接続情報
            $dsn = 'mysql:dbname=my_tables;host=localhost;charset=utf8mb4';
            $user = 'ユーザ名';
            $password = 'パスワード';
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