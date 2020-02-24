<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="staff.css">
</head>
<body>
	<?php
		try {

			$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
			$user = 'root';
			$password = '123456';
			$dbh = new PDO($dsn, $user, $password);
			$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT code,name FROM mst_staff WHERE 1';
			$stmt = $dbh -> prepare($sql);
			$stmt -> execute();

			$dbh = null;

			print '<strong>スタッフ一覧</strong><br>';

			print '<form method="post" action="staff_branch.php">';
			while (true) {
				$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

				if ($rec == false) {
					break;
				}

				print '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
				print '<strong>'.$rec['name'];
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
</body>
</html>