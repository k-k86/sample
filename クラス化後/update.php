<?php
    require_once('connect.php');
    //DB�ڑ���񂪏�����Ă���N���X��e�N���X�Ƃ���
    class Update extends Connect {
        //DB�ɕۑ�����Ă���f�[�^���X�V���郁�\�b�h
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