<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['login']) == false) {
		print 'ログインしてください。<br>';
		print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
		exit();
	}else{
		print $_SESSION['staff_name'];
		print 'さんログイン中<br>';
		print '<br>';
	}
?>

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

	<strong>スタッフ編集</strong><br>
	<strong>スタッフコード</strong><br>
	<?php print
		'<strong>'.$staff_code.'</strong>';
	?>
	<br>
	<br>


	<form method="post" action="staff_edit_check.php">
		<input type="hidden" name="code" value="<?php print $staff_code; ?>">

		<strong>スタッフ名</strong><br>
		<input type="text" name="name" value="<?php print $staff_name; ?>">
		<br>

		<strong>パスワードを入力してください</strong><br>
		<input type="password" name="pass">
		<br>

		<strong>パスワードをもう一度入力してください</strong><br>
		<input type="password" name="pass2">
		<br>

		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>
</body>
</html>