<?php
	session_start();


	if (isset($_SESSION['user_id'])) {//ログインしているとき
		echo'<input type="submit" name="display" value="一覧表示">';
		echo'<input type="submit" name="">';

	} else {//ログインしていない時
    	$msg = 'ログインしていません';
    	$link = '<a href="login_form.php">ログイン</a>';
	}
?>
<html>
	<head>
		<meta charset=utf-8>
		<title>顧客管理システム</title>
	</head>
	<body>
		<input type="submit">
		<h1><?php echo $msg; ?></h1>
		<?php echo $link; ?>
	</body>
</html>