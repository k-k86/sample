<?php
    require_once('connect.php');
    //DB接続情報がかかれているクラスを親クラスにする
    class Delete extends Connect {

        public function DeleteDate($check) {
            $sql = 'DELETE FROM samples WHERE id = ?';
            $sth = $this->pdo()->prepare($sql);
            foreach ($check as $chk ) {
                $id = (int)$chk;
                $sth->bindValue(1, $id, PDO::PARAM_INT);
                $sth->execute();
            }
        }
    }
?>