<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="staff.css">
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