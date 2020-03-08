<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['member_login']) == false) {
		print 'ようこそゲストさん<br>';
		print '<a href="member_login.html">ログインはこちら</a>';
		print '<br>';
	}else{
		print 'ようこそ';
		print $_SESSION['member_name'].'様';
		print '<a href="member_logout.php">ログアウト</a>';
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

			$cart = $_SESSION['cart'];
			$qty = $_SESSION['qty'];
			$max = count($cart);

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = '123456';
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			foreach ($cart as $key => $value) {
				$sql = 'SELECT code, name, price, image FROM mst_product WHERE code = ?';
				$stmt = $dbh -> prepare($sql);
				$data[0] = $value;
				$stmt -> execute($data);

				$rec = $stmt->fetch(PDO::FETCH_ASSOC);

				$pro_name[] = $rec['name'];
				$pro_price[] = $rec['price'];

				if ($rec['image'] == ''){
					$pro_image[] = '';
				}else{
					$pro_image[] = '<img style="width: 200px; height: 200px;" src="../product/image/'.$rec['image'].'">';
				}
			}

			$dbh = null;

		} catch (Exception $e) {

			print 'ただいま障害により大変ご迷惑をおかけしております。';
			exit();

		}

	?>

	<strong>カート</strong>
	<br>

	<form method="post" action="qty_change.php">

	<?php for ($i = 0; $i < $max; $i++) { ?>
		<?php print $pro_name[$i]; ?>
		<!-- <input type="checkbox" name="delete<?php print $i; ?>"> -->
		<br>
		<?php print $pro_image[$i].'<br>'; ?>
		<?php print $pro_price[$i]; ?>円
		<input type="text" name="qty<?php print $i;?>" value="<?php print $qty[$i]; ?>">個
		<br>
		<?php print $pro_price[$i] * $qty[$i]; ?>円
		<br>
	<?php } ?>

		<input type="hidden" name="max" value="<?php print $max; ?>">
		<input type="submit" value="数量を変更する">
		<br>
		<input type="button" onclick="history.back()" value="戻る">
	</form>
</body>
</html>