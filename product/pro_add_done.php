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

			$pro_name = $_POST['name'];
			$pro_price = $_POST['price'];
			$pro_image_name = $_POST['image_name'];

			$pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
			$pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = 123456;
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'INSERT INTO mst_product(name, price, image) VALUES (?,?,?)';
			$stmt = $dbh -> prepare($sql);
			$data[] = $pro_name;
			$data[] = $pro_price;
			$data[] = $pro_image_name;
			$stmt -> execute($data);

			$dbh = null;

			print '<strong>';
			print $pro_name;
			print 'を追加しました。';
			print '</strong><br>';

		} catch (Exception $e) {
			print 'ただいま通信障害により大変ご迷惑をおかけしています。';
			exit();

		}
	?>

	<a href="pro_list.php">戻る</a>
</body>
</html>