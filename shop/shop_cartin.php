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

			$pro_code = $_GET['procode'];

			if (isset($_SESSION['cart']) == true) {
				$cart = $_SESSION['cart'];
				$qty = $_SESSION['qty'];
				if (in_array($pro_code, $cart) == true) {
					print 'その商品はすでにカートに入っています。<br>';
					print '<a href="shop_list.php">商品一覧に戻る</a>';
					exit();
				}
			}
			$cart[] = $pro_code;
			$qty[] = 1;
			$_SESSION['cart'] = $cart;
			$_SESSION['qty'] = $qty;

		} catch (Exception $e) {

			print 'ただいま障害により大変ご迷惑をおかけしております。';
			exit();

		}

	?>

	<strong>カートに追加しました。</strong>
	<br>

	<a href="shop_list.php">商品一覧に戻る</a>
	<br>
</body>
</html>