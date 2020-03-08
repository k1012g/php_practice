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
	<?php

		require_once('../common/common.php');

		$post = sanitize($_POST);

		$pro_code = $post['code'];
		$pro_name = $post['name'];
		$pro_price = $post['price'];
		$pro_image_name_old = $post['image_name_old'];
		$pro_image = $_FILES['image'];

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