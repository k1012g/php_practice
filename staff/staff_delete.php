<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
</head>
<body>
	<?php

		try {

			$staff_code = $_GET['staffcode'];

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = '123456';
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT name FROM mst_staff WHERE code = ?';
			$stmt = $dbh -> prepare($sql);
			$data[] = $staff_code;
			$stmt -> execute($data);

			$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
			$staff_name = $rec['name'];

			$dbh = null;

		} catch (Exception $e) {

			print 'ただいま障害により大変ご迷惑をおかけしております。';
			exit();

		}

	?>

	<strong>スタッフ削除</strong><br>
	<strong>スタッフコード</strong><br>
	<?php print
		'<strong>'.$staff_code.'</strong>';
	?>
	<br>
	<strong>
		スタッフ名
		<?php print $staff_name; ?>
		<br>
		このスタッフを削除してもよろしいですか?
		<br>
	</strong>



	<form method="post" action="staff_delete_done.php">
		<input type="hidden" name="code" value="<?php print $staff_code; ?>">
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>
</body>
</html>