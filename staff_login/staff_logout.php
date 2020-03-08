<?php
	session_start();
	$_SESSION = array();
	if (isset($_COOKIE[session_name()]) == true) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
</head>
<body>
	<strong>ログアウトしました。</strong>
	<br>

	<a href="../staff_login/staff_login.html">ログイン画面へ</a>
	<br>
</body>
</html>