<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();


	$dsn = "mysql:host=localhost; dbname=cust_sys_db; charset=utf8";
	$username = "root";
	$password = "ozi123";
	try {
    	$dbh = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
    	$msg = $e->getMessage();
	}


		$user_id = $_POST['userid'];
		$password = $_POST['password'];
		$msg = '';
		$link = '';

		$sql = 'SELECT * FROM m_user WHERE user_id = :id';
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id', $user_id);
		$stmt->execute();
		$result = $stmt->fetch();


		if($result !== false) {
			if ($user_id == $result['user_id'] && $password == $result['password']) {
    			//DBのユーザー情報をセッションに保存
    			$_SESSION['user_id'] = $result['user_id'];
    			$_SESSION['password'] = $result['password'];
    			header('Location: http://localhost/project_顧客sys/index.php');
				exit();
			} elseif($password != $result['password']) {
				$msg = 'パスワードが間違っています。';
    			$link = '<a href="login_form.php">戻る</a>';
			}

		} else {
			$msg = '入力されたIDが間違っています。';
			$link = '<a href="login_form.php">ログインページに戻る</a>';
		}
	//}
?>
<html>
	<body>
		<h1><?php echo $msg; ?></h1>
		<?php echo $link; ?>
	</body>
<html>