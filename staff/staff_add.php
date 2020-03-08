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
	<form action="staff_add_check.php" method="post">
		<strong>スタッフ名を入力してください</strong><br>
		<input type="text" name="name"><br>

		<strong>パスワードを入力してください</strong><br>
		<input type="password" name="pass"><br>

		<strong>パスワードをもう一度入力してください</strong><br>
		<input type="password" name="pass2"><br>

		<!-- <input type="button" onclick="history.back()" value="戻る"> -->
		<input type="submit" name="OK">
	</form>
</body>
</html>