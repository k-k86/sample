<!DOCTYPE HTML>
<html>
	<head>
		<title>顧客情報一覧</title>
		<meta charset=utf-8>
	</head>
</html>

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

		echo "<div>";
		echo "<form method='post' action='delete.php'>";
		echo "<input type='submit' name='delete' value='検索'>";
		echo "</form>";
		echo "<form method='post' action='delete.php'>";
		echo "<input type='submit' name='delete' value='削除'>";
		echo "</form>";
		echo "</div>";

		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo "<table border=1 style=border-collapse:collapse;>";
			echo "<tr>";
			echo "<td>";
			echo "";
			echo "</td>";
			echo "<td>";
			echo "顧客番号";
			echo "</td>";
			echo "<td>";
			echo "　氏名　";
			echo "</td>";
			echo "<td>";
			echo "氏名(カナ)";
			echo "</td>";
			echo "<td>";
			echo "性別(1or2)";
			echo "</td>";
			echo "<td>";
			echo "メールアドレス";
			echo "</td>";
			echo "<td>";
			echo "電話番号";
			echo "</td>";
			echo "<td>";
			echo "生年月日";
			echo "</td>";
			echo "<td>";
			echo "住所";
			echo "</td>";
			echo "<td>";
			echo "郵便番号";
			echo "</td>";
			echo "<td>";
			echo "登録日";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td><input type="checkbox" name="check[]" value="{$result['cust_no']}"></td>";
			echo "<td>";
			echo $result['cust_no'];
			echo "</td>";
			echo "<td>";
			echo $result['last_nm']; 
			echo $result['fast_nm'];
    		echo "</td>";
    		echo "<td>";
			echo $result['last_nm_kana'];
			echo $result['fast_nm_kana'];
    		echo "</td>";
			echo "<td>";
			echo $result['gender_cd'];
			echo "</td>";
			echo "<td>";
			echo $result['mail_address'];
			echo "</td>";
			echo "<td>";
			echo $result['tel_no'];
			echo "</td>";
			echo "<td>";
			echo $result['birth_date'];
			echo "</td>";
			echo "<td>";
			echo $result['home_address'];
			echo "</td>";
			echo "<td>";
			echo $result['post_number'];
			echo "</td>";
			echo "<td>";
			echo $result['reg_date'];
			echo "</td>";
    		echo "</tr>";
    		echo "</table>";
	}
?>