<?php
    require_once('connect.php');
    //DB接続情報が書かれているクラスを親クラスとする
    class Insert extends Connect {
        //DBにデータを保存する為の処理
        public function InsertDate($name, $content) {

            $sql = 'INSERT INTO samples (name, content, datetime) VALUES (?, ?, NOW())';
            $sth = $this->pdo()->prepare($sql);
            $sth->bindValue(1, $name, PDO::PARAM_STR);
            $sth->bindValue(2, $content, PDO::PARAM_STR);
            $sth->execute();
        }
    }
?>