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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
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

			print '<form method="post" action="pro_branch.php">';
			while (true) {
				$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

				if ($rec == false) {
					break;
				}

				print '<input type="radio" name="procode" value="'.$rec['code'].'">';
				print '<strong>'.$rec['name'].'---';
				print $rec['price'].'円';
				print '</strong><br>';
			}

			print '<input type="submit" name="disp" value="詳細">';
			print '<input type="submit" name="add" value="追加">';
			print '<input type="submit" name="edit" value="編集">';
			print '<input type="submit" name="delete" value="削除">';
			print '</form>';

		} catch (Exception $e) {
			print 'ただいま通信障害により大変ご迷惑をおかけしています。';
			exit();
		}

	?>
	<br>
	<a href="../staff_login/staff_top.php">トップメニューへ</a>
	<br>
</body>
</html>