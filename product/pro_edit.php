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

			$sql = 'SELECT name, price, image FROM mst_product WHERE code = ?';
			$stmt = $dbh -> prepare($sql);
			$data[] = $pro_code;
			$stmt -> execute($data);

			$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
			$pro_name = $rec['name'];
			$pro_price = $rec['price'];
			$pro_image_name_old = $rec['image'];

			$dbh = null;

			if ($pro_image_name_old == '') {
				$disp_image = '';
			}else{
				$disp_image = '<img style="width: 200px; height: 200px;" src="./image/'.$pro_image_name_old.'">';
			}

		} catch (Exception $e) {

			print 'ただいま障害により大変ご迷惑をおかけしております。';
			exit();

		}

	?>

	<strong>商品編集</strong><br>
	<strong>商品コード</strong><br>
	<?php print
		'<strong>'.$pro_code.'</strong>';
	?>
	<br>


	<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
		<input type="hidden" name="code" value="<?php print $pro_code; ?>">

		<strong>商品名</strong><br>
		<input type="text" name="name" value="<?php print $pro_name; ?>">
		<br>

		<strong>価格</strong><br>
		<input type="price" name="price" value="<?php print $pro_price; ?>">
		<br>

		<input type="hidden" name="image_name_old" value="<?php print $pro_image_name_old; ?>">

		<?php print $disp_image; ?>
		<br>

		<strong>画像を選択してください</strong>
		<br>

		<input type="file" name="image">
		<br>

		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>
</body>
</html>