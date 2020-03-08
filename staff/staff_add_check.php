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

		$staff_name = $post['name'];
		$staff_pass = $post['pass'];
		$staff_pass2 = $post['pass2'];

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
			print '<form method="post" action="staff_add_done.php">';
			print '<input type="hidden" name="name" value="'.$staff_name.'">';
			print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '<input type="submit" value="OK">';
			print '</form>';
		}
	?>
</body>
</html>