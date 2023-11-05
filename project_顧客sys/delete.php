<!DOCTYPE HTML>
<html>
	<head>
		<title>顧客情報一覧</title>
		<meta charset=utf-8>
	</head>
</html>

<?php
	//session_start();


	$dsn = "mysql:host=localhost; dbname=cust_sys_db; charset=utf8";
	$username = "root";
	$password = "ozi123";
	try {
    	$dbh = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
    	$msg = $e->getMessage();
	}

	$check_array = filter_input(INPUT_POST, 'check',  FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
var_dump($check_array);

	if(isset($check_array)) {

		print '削除しました';
		$sql = 'DELETE from m_customer where cust_no = :cust_no';
		$stmt = $dbh->prepare($sql);
		foreach ($_POST['check'] as $chk ) {
			//どのチェックボックス(id)が選択されているか
			$id = (int)$chk;
			//bindValue関数でデータをセット
			$stmt->bindValue(':cust_no', $id, PDO::PARAM_INT);
			//SQL文を実行
			$stmt->execute();
		}

	} elseif(empty($_POST['check'])) {
		print 'チェックボックスにチェックが入っていません！';

	}