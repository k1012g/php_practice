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
	<link rel="stylesheet" type="text/css" href="../css/tyle.css">
</head>
<body>
	<?php
		try {

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = '123456';
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT code,name,price FROM mst_product WHERE 1';
			$stmt = $dbh -> prepare($sql);
			$stmt -> execute();

			$dbh = null;

			print '<strong>商品一覧</strong><br>';

			while (true) {
				$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

				if ($rec == false) {
					break;
				}

				print '<a href="shop_product.php?procode='.$rec['code'].'">';
				print '<strong>'.$rec['name'].'---';
				print $rec['price'].'円';
				print '</a>';
				print '</strong><br>';
			}

			print '<a href="shop_cartlook.php">カートを見る</a><br>';

		} catch (Exception $e) {
			print 'ただいま通信障害により大変ご迷惑をおかけしています。';
			exit();
		}

	?>
</body>
</html>