<?php
	session_start();


	if (isset($_SESSION['user_id'])) {//ログインしているとき
		header('Location: http://localhost/project_顧客sys/menu.php');
		exit();
	} else {//ログインしていない時
    	$msg = 'ログインしていません';
    	$link = '<a href="login_form.php">ログイン</a>';
	}
?>
<html>
	<head>
		<meta charset=utf-8>
		<title>エラーページ</title>
	</head>
	<body>
		<h1><?php echo $msg; ?></h1>
		<?php echo $link; ?>
	</body>
</html>