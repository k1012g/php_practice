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
	<strong>ショップ管理トップ</strong>
	<br>

	<a href="../staff/staff_list.php">スタッフ管理</a>
	<br>

	<a href="../product/pro_list.php">商品管理</a>
	<br>

	<a href="staff_logout.php">ログアウト</a>
	<br>
</body>
</html>