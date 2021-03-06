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

			$pro_code = $_GET['procode'];

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = '123456';
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT name, image FROM mst_product WHERE code = ?';
			$stmt = $dbh -> prepare($sql);
			$data[] = $pro_code;
			$stmt -> execute($data);

			$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
			$pro_name = $rec['name'];
			$pro_image_name = $rec['image'];

			$dbh = null;

			if ($pro_image_name == '') {
				$disp_image = '';
			}else{
				$disp_image = '<img style="width: 200px; height: 200px;" src="./image/'.$pro_image_name.'">';
			}

		} catch (Exception $e) {

			print 'ただいま障害により大変ご迷惑をおかけしております。';
			exit();

		}

	?>

	<strong>商品削除</strong><br>
	<strong>商品コード</strong><br>
	<?php print
		'<strong>'.$pro_code.'</strong>';
	?>
	<br>
	<strong>
		商品名
		<?php print $pro_name; ?>
		<br>
		<?php print $disp_image; ?>
		<br>
		この商品を削除してもよろしいですか?
		<br>
	</strong>



	<form method="post" action="pro_delete_done.php">
		<input type="hidden" name="code" value="<?php print $pro_code; ?>">
		<input type="hidden" name="image_name" value="<?php print $pro_image_name; ?>">
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>
</body>
</pro