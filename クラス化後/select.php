<?php
    require_once('connect.php');

    //DB�ڑ���񂪏�����Ă���t�@�C����e�N���X�ɂ���
    class Select extends Connect {
        //�u���E�U���DB�ɕۑ�����Ă���f�[�^��ǂݍ��ވׂ̃��\�b�h
        public function SelectDate() {

        $sql = 'SELECT id, name, content, datetime FROM samples ORDER BY datetime DESC limit 3';
        $sth = $this->pdo()->prepare($sql);
        $sth->execute();
        return $sth;
        }
    }
?>