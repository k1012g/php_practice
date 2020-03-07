<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
</head>
<body>
	<?php

		$staff_code = $_POST['code'];
		$staff_name = $_POST['name'];
		$staff_pass = $_POST['pass'];
		$staff_pass2 = $_POST['pass2'];

		$staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
		$staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');
		$staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');

		$flg = true;

		if ($staff_name == '') {
			print '<strong>スタッフ名が入力されていません。</strong><br>';
			$flg = false;
		}else{
			print '<strong>スタッフ名 : ';
			print $staff_name;
			print '</strong><br>';
		}

		if ($staff_pass == '') {
			print '<strong>パスワードが入力されていません。</strong><br>';
			$flg = false;
		}

		if ($staff_pass != $staff_pass2) {
			print '<strong>パスワードが一致しません。</strong><br>';
			$flg = false;
		}

		if ($flg == false) {
			print '<form>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
		}else{
			$staff_pass = crypt($staff_pass);
			print '<form method="post" action="staff_edit_done.php">';
			print '<input type="hidden" name="code" value="'.$staff_code.'">';
			print '<input type="hidden" name="name" value="'.$staff_name.'">';
			print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '<input type="submit" value="OK">';
			print '</form>';
		}
	?>
</body>
</html>