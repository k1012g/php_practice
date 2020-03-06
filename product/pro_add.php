<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
</head>
<body>
	<strong style="font-size: 35px;">商品追加</strong>
	<br>

	<form action="pro_add_check.php" method="post" enctype="multipart/form-data">
		<strong>商品名を入力してください</strong>
		<br>
		<input type="text" name="name">
		<br>

		<strong>価格を入力してください</strong>
		<br>

		<input type="text" name="price">
		<br>

		<input type="file" name="image">
		<br>

		<input type="submit" name="OK">
	</form>
</body>
</html>