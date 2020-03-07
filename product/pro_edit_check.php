<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
</head>
<body>
	<?php

		$pro_code = $_POST['code'];
		$pro_name = $_POST['name'];
		$pro_price = $_POST['price'];
		$pro_image_name_old = $_POST['image_name_old'];
		$pro_image = $_FILES['image'];

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

		if ($pro_image['size'] > 0){
			if ($pro_image['size'] > 1000000){
				print '画像が大きすぎます。';
				$flg = false;
			}else{
				move_uploaded_file($pro_image['tmp_name'], './image/'.$pro_image['name']);
				print '<img style="width: 200px; height: 200px;" src="./image/'.$pro_image['name'].'">';
				print '<br>';
			}
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
			print '<input type="hidden" name="image_name_old" value="'.$pro_image_name_old.'">';
			print '<input type="hidden" name="image_name" value="'.$pro_image['name'].'">';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '<input type="submit" value="OK">';
			print '</form>';
		}
	?>
</body>
</html></html>