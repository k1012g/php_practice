<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="staff.css">
</head>
<body>
	<?php

		$pro_code = $_POST['code'];
		$pro_name = $_POST['name'];
		$pro_price = $_POST['price'];

		$pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');
		$pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
		$pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

		$flg = true;

		if ($pro_name == '') {
			print '<strong>商品名が入力されていません。</strong><br>';
			$flg = false;
		}else{
			print '<strong>商品名 : ';
			print $pro_name;
			print '</strong><br>';
		}

		if(preg_match("/^[0-9]+$/", $pro_price) == 0){
			print '<strong>価格をきちんと入力してください。</strong><br>';
			$flg = false;
		}else{
			print '<strong>価格 : ';
			print $pro_price;
			print '円</strong><br>';
		}

		if ($flg == false) {
			print '<form>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
		}else{
			print '<strong>上記のように変更します。</strong><br>';
			print '<form method="post" action="pro_edit_done.php">';
			print '<input type="hidden" name="code" value="'.$pro_code.'">';
			print '<input type="hidden" name="name" value="'.$pro_name.'">';
			print '<input type="hidden" name="price" value="'.$pro_price.'">';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '<input type="submit" value="OK">';
			print '</form>';
		}
	?>
</body>
</html></html>