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

		$f_name = $post['f_name'];
		$s_name = $post['s_name'];
		$email = $post['email'];
		$postal1 = $post['postal1'];
		$postal2 = $post['postal2'];
		$address = $post['address'];
		$tel = $post['tel'];

		$flg = true;

		if ($f_name == ''){
			print '姓が入力されていません。<br><br>';
			$flg = false;
		}else{
			print 'お名前(姓)<br>';
			print $f_name;
			print '<br><br>';
		}

		if ($s_name == ''){
			print '名が入力されていません。<br><br>';
			$flg = false;
		}else{
			print 'お名前(名)<br>';
			print $s_name;
			print '<br><br>';
		}

		if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0) {
			print 'メールアドレスが正確に入力されていません。<br><br>';
			$flg = false;
		}else{
			print 'メールアドレス<br>';
			print $email;
			print '<br><br>';
		}

		if (preg_match("/^[0-9]+$/", $postal1) == 0 || preg_match("/^[0-9]+$/", $postal2) == 0) {
			print '郵便番号が正確に入力されていません。<br><br>';
			$flg = false;
		}else{
			print '郵便番号<br>';
			print $postal1.'-'.$postal2;
			print '<br><br>';
		}

		if ($address == '') {
			print '住所が入力されていません。<br><br>';
			$flg = false;
		}else{
			print '住所<br>';
			print $address;
			print '<br><br>';
		}

		if (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0) {
			print '電話番号が正確に入力されていません。<br><br>';
			$flg = false;
		}else{
			print '電話番号<br>';
			print $tel;
			print '<br>';
		}

		if ($flg == true) {
			print '<form method="post" action="shop_form_done.php">';
				print '<input type="hidden" name="f_name" value="'.$f_name.'">';
				print '<input type="hidden" name="s_name" value="'.$s_name.'">';
				print '<input type="hidden" name="email" value="'.$email.'">';
				print '<input type="hidden" name="postal1" value="'.$postal1.'">';
				print '<input type="hidden" name="postal2" value="'.$postal2.'">';
				print '<input type="hidden" name="address" value="'.$address.'">';
				print '<input type="hidden" name="tel" value="'.$tel.'">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="OK">';
			print '</form>';
		}else{
			print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
		}

	?>
</body>
</html>