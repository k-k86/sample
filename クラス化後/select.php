<?php
    require_once('connect.php');

    //DB接続情報が書かれているファイルを親クラスにする
    class Select extends Connect {
        //ブラウザ上にDBに保存されているデータを読み込む為のメソッド
        public function SelectDate() {

        $sql = 'SELECT id, name, content, datetime FROM samples ORDER BY datetime DESC limit 3';
        $sth = $this->pdo()->prepare($sql);
        $sth->execute();
        return $sth;
        }
    }
?>