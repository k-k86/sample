<?php

	session_start();

	if(isset($_SESSION['user_id'])) {
		echo'<h1>顧客管理システム</h1>';
		echo'<form method="post" action="display.php">';
		echo'<input type="submit" name="display" value="顧客情報一覧表示">';
		echo'</form>';
		echo'<form method="post" action="cust_post.php">';
		echo'<input type="submit" name="post" value="顧客情報新規登録">';
		echo'</form>';
		echo'<form method="post" action="logout.php">';
		echo'<input type="submit" name="logout" value="ログアウト">';
		echo'</form>';
	} else {
		print '<h1>ログインしていません</h1>';
		print '<a href="login_form.php">ログインページ</a>';
	}
?>



<!DOCTYPE HTML>
<html>
	<head>
		<meta charset=utf-8>
		<title>顧客管理システム</title>
	</head>
</html>

