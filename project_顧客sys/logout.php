<?php
	session_start();
	$_SESSION = array();//セッションの中身をすべて削除
	session_destroy();//セッションを破壊
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ログアウトページ</title>
	</head>
	<body>
		<p>ログアウトしました。</p>
		<a href="login_form.php">ログインへ</a>
	</body>
</html>