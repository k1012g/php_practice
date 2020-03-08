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

			$pro_code = $_POST['code'];
			$pro_image = $_POST['image_name'];

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = '123456';
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'DELETE FROM mst_product WHERE code = ?';
			$stmt = $dbh -> prepare($sql);
			$data[] = $pro_code;
			$stmt -> execute($data);

			$dbh = null;

			if ($pro_image_name != '') {
				unlink('./image/'.$pro_image_name);
			}

		} catch (Exception $e) {
			print 'ただいま通信障害により大変ご迷惑をおかけしています。';
			exit();

		}
	?>

	<strong>削除しました。</strong>
	<br>

	<a href="pro_list.php">戻る</a>
</body>
</html>