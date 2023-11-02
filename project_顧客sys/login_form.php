<!doctype html>
<html>
	<head>
    	<meta charset="UTF-8">
        <title>ログイン</title>
	</head>
	<body>
        <h1>ログイン画面</h1>
        <form id="loginForm" name="loginForm" action="login.php" method="POST">
            <!--<div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>-->
            	<label for="userid">ユーザーID</label><input type="text" name="userid" placeholder="ユーザーIDを入力" required>
            	<br>
            	<label for="password">パスワード</label><input type="password" id="password" name="password" placeholder="パスワードを入力" required>
            	<br>
            	<input type="submit" id="login" name="login_sub" value="ログイン">
        </form>
    </body>
</html>