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

			require_once('../common/common.php');

			$post = sanitize($_POST);

			$staff_name = $post['name'];
			$staff_pass = $post['pass'];

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = 123456;
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'INSERT INTO mst_staff(name, password) VALUES (?,?)';
			$stmt = $dbh -> prepare($sql);
			$data[] = $staff_name;
			$data[] = $staff_pass;
			$stmt -> execute($data);

			$dbh = null;

			print '<strong>';
			print $staff_name;
			print 'さんを追加しました。';
			print '</strong><br>';

		} catch (Exception $e) {
			print 'ただいま通信障害により大変ご迷惑をおかけしています。';
			exit();

		}
	?>

	<a href="staff_list.php">戻る</a>
</body>
</html>