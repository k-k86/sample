<!DOCTYPE HTML>
<html>
	<head>
		<title>顧客情報一覧</title>
		<meta charset=utf-8>
	</head>
	<body>
<?php

	session_start();


	//if(isset($_SESSION['user_id'])) {


		echo "<h1>顧客情報一覧</h1>";


		$dsn = "mysql:host=localhost; dbname=cust_sys_db; charset=utf8";
		$username = "root";
		$password = "ozi123";
		try {
    		$dbh = new PDO($dsn, $username, $password);
		} catch (PDOException $e) {
    		$msg = $e->getMessage();
		}

		$sql = 'select * from m_customer';
		$stmt = $dbh->query($sql);

		$body1 = <<<EOD
			<div>
				<form method='post' action='hoge.php'>
					<input type='submit' name='search' value='検索'>
				</form>
				<form method='post' action='delete.php'>
					<input type='submit' name='delete' value='削除'>
			</div>
			<table border=1 style=border-collapse:collapse;>
				<tr>
					<td>
					</td>
					<td>
						顧客番号
					</td>
					<td>
						氏名
					</td>
					<td>
						氏名(カナ)
					</td>
					<td>
						性別(1or2)
					</td>
					<td>
						メールアドレス
					</td>
					<td>
						電話番号
					</td>
					<td>
						生年月日
					</td>
					<td>
						住所
					</td>
					<td>
						郵便番号
					</td>
					<td>
						登録日
					</td>
				</tr>
			</table>
		EOD;
		echo $body1;


		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo <<<EOF
			<table border=1 style=border-collapse:collapse;>
				<tr>
				<td><input type="checkbox" name="check[]" value="{$result['cust_no']}"></td>
				<td>
				{$result['cust_no']}
				</td>
				<td>
				{$result['last_nm']}
				{$result['fast_nm']}
				</td>
				<td>
				{$result['last_nm_kana']}
				{$result['fast_nm_kana']}
				</td>
				<td>
				{$result['gender_cd']}
				</td>
				<td>
				{$result['mail_address']}
				</td>
				<td>
				{$result['tel_no']}
				</td>
				<td>
				{$result['birth_date']}
				</td>
				<td>
				{$result['home_address']}
				</td>
				<td>
				{$result['post_number']}
				</td>
				<td>
				{$result['reg_date']}
				</td>
				</tr>
				</form>
			</table>
		EOF;

	}
?>
	</body>
</html>