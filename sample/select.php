<?php
    require_once('connect.php');


    class Select extends Connect {

        public function SelectDate() {

        $sql = 'SELECT id, name, content, datetime FROM samples ORDER BY datetime DESC limit 3';
        $sth = $this->pdo()->prepare($sql);
        $sth->execute();
        return $sth;
        }
    }
?>