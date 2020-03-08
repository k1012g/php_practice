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

			$pro_code = $post['code'];
			$pro_name = $post['name'];
			$pro_price = $post['price'];
			$pro_image_name_old = $post['image_name_old'];
			$pro_image_name = $post['image_name'];

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = 123456;
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'UPDATE mst_product SET name = ?, price = ?, image = ? WHERE code = ?';
			$stmt = $dbh -> prepare($sql);
			$data[] = $pro_name;
			$data[] = $pro_price;
			$data[] = $pro_image_name;
			$data[] = $pro_code;
			$stmt -> execute($data);

			$dbh = null;

			if ($pro_image_name_old != $pro_image_name) {
				if ($pro_image_name_old != '') {
					unlink('./image/'.$pro_image_name_old);
				}
			}

			print '<strong>';
			print '修正しました。';
			print '</strong><br>';

		} catch (Exception $e) {
			print 'ただいま通信障害により大変ご迷惑をおかけしています。';
			exit();

		}
	?>

	<a href="pro_list.php">戻る</a>
</body>
</html>