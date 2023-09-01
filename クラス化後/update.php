<?php
    require_once('connect.php');
    //DB接続情報が書かれているクラスを親クラスとする
    class Update extends Connect {
        //DBに保存されているデータを更新するメソッド
        public function UpdateDate($name, $content, $arrayCheck) {
        
            $sql = 'UPDATE samples SET name = ?, content = ? WHERE id = ?';
            $sth = $this->pdo()->prepare($sql);
            foreach ($arrayCheck as $chk ) {
                $id = (int)$chk;
                $sth->bindValue(1, $name, PDO::PARAM_STR);
                $sth->bindValue(2, $content, PDO::PARAM_STR);
                $sth->bindValue(3, $id, PDO::PARAM_INT);
                $sth->execute();
            }
        }
    }
?>