<?php
    require_once('connect.php');
    //DB�ڑ���񂪏�����Ă���N���X��e�N���X�Ƃ���
    class Insert extends Connect {
        //DB�Ƀf�[�^��ۑ�����ׂ̏���
        public function InsertDate($name, $content) {

            $sql = 'INSERT INTO samples (name, content, datetime) VALUES (?, ?, NOW())';
            $sth = $this->pdo()->prepare($sql);
            $sth->bindValue(1, $name, PDO::PARAM_STR);
            $sth->bindValue(2, $content, PDO::PARAM_STR);
            $sth->execute();
        }
    }
?>