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

			if (isset($_SESSION['cart']) == true) {
				$cart = $_SESSION['cart'];
				$qty = $_SESSION['qty'];
				$max = count($cart);
			}else{
				$max = 0;
			}

			if ($max == 0) {
				print '<strong>カートは空です。</strong>';
				print '<br><br>';
				print '<a href="shop_list.php">商品一覧に戻る</a>';
				exit();
			}

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
		<table border="1">
			<tr>
				<td>商品</td>
				<td></td>
				<td>価格</td>
				<td>数量</td>
				<td>小計</td>
				<td>削除する</td>
			</tr>
			<?php for ($i = 0; $i < $max; $i++) { ?>
				<tr>
					<td>
						<?php print $pro_name[$i]; ?>
					</td>
					<td>
						<?php print $pro_image[$i]; ?>
					</td>
					<td>
						<?php print $pro_price[$i]; ?>円
					</td>
					<td>
						<input type="number" min="1" max="10" name="qty<?php print $i;?>" value="<?php print $qty[$i]; ?>">個
						<input type="submit" value="数量を変更する">
					</td>
					<td>
						<?php print $pro_price[$i] * $qty[$i]; ?>円
					</td>
					<td>
						<input type="checkbox" name="delete<?php print $i; ?>">
					</td>
				</tr>
			<?php } ?>
		</table>

		<input type="hidden" name="max" value="<?php print $max; ?>">
		<a href="shop_list.php">商品一覧へ</a>
		<br>
		<input type="button" onclick="history.back()" value="戻る">
	</form>

	<br>
	<a href="shop_form.html">ご購入手続きへ進む</a>
</body>
</html>