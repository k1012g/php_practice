<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php

	try {
		require_once('../common/common.php');

		$post = sanitize($_POST);

		$f_name = $post['f_name'];
		$s_name = $post['s_name'];
		$email = $post['email'];
		$postal1 = $post['postal1'];
		$postal2 = $post['postal2'];
		$address = $post['address'];
		$tel = $post['tel'];

		print $f_name.$s_name.'様<br>';
		print 'ご注文ありがとうございます。<br>';
		print $email.'にメールを送りましたのでご確認ください。<br>';
		print '商品は以下の住所に発送させていただきます。<br>';
		print $postal1.'-'.$postal2.'<br>';
		print $address.'<br>';
		print '電話番号<br>';
		print $tel.'<br>';

		$email_body = '';
		$email_body .= $f_name.$s_name."様\n\nこの度はご注文ありがとうございました。\n";
		$email_body .= "\n";
		$email_body .= "ご注文いただいた商品\n";
		$email_body .= "---------------------\n";

		$cart = $_SESSION['cart'];
		$qty = $_SESSION['qty'];
		$max = count($cart);

		$dsn = 'mysql:dbname=ec_practice;host=localhost;charset=utf8';
		$user = 'root';
		$password = '123456';
		$dbh = new PDO($dsn, $user, $password);
		$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		for ($i = 0; $i < $max; $i++) {
			$sql = 'SELECT name, price FROM mst_product WHERE code = ?';
			$stmt = $dbh -> prepare($sql);
			$data[0] = $cart[$i];
			$stmt -> execute($data);

			$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

			$name = $rec['name'];
			$price[] = $rec['price'];
			$ordered_qty[$i] = $qty[$i];
			$subtotal = $price[$i] * $ordered_qty[$i];

			$email_body .= $name.' ';
			$email_body .= $price[$i].'円 x ';
			$email_body .= $ordered_qty[$i].'個 = ';
			$email_body .= $subtotal."円\n";
		}

		$sql = 'LOCK TABLES data_sales WRITE, data_sales_product WRITE';
		$stmt = $dbh -> prepare($sql);
		$stmt -> execute();

		$sql = 'INSERT INTO data_sales (code_member, first_name, second_name, email, postal1, postal2, address, tel) VALUES (?,?,?,?,?,?,?,?)';
		$stmt = $dbh -> prepare($sql);
		$data = array();
		$data[] = 0;
		$data[] = $f_name;
		$data[] = $s_name;
		$data[] = $email;
		$data[] = $postal1;
		$data[] = $postal2;
		$data[] = $address;
		$data[] = $tel;
		$stmt -> execute($data);

		$sql = 'SELECT LAST_INSERT_ID()';
		$stmt = $dbh -> prepare($sql);
		$stmt -> execute();
		$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
		$lastcode = $rec['LAST_INSERT_ID()'];

		for ($i = 0; $i < $max; $i++) {
			$sql = 'INSERT INTO data_sales_product (code_sales, code_product, price, quantity) VALUES (?,?,?,?)';
			$stmt = $dbh -> prepare($sql);
			$data = array();
			$data[] = $lastcode;
			$data[] = $cart[$i];
			$data[] = $price[$i];
			$data[] = $ordered_qty[$i];
			$stmt -> execute($data);

		}

		$sql = 'UNLOCK TABLES';
		$stmt = $dbh -> prepare($sql);
		$stmt -> execute();

		$dbh = null;

		$email_body .= "送料は無料です。\n";
		$email_body .= "---------------------\n";
		$email_body .= "\n";
		$email_body .= "代金は以下の口座にお振込ください。\n";
		$email_body .= "偽物銀行 東京支店 普通口座 1234567\n";
		$email_body .= "入金確認が取れ次第、梱包し発送させていただきます。\n";
		$email_body .= "\n";
		$email_body .= "□□□□□□□□□□□□□□□□□□□\n";
		$email_body .= "- Private Select -\n";
		$email_body .= "\n";
		$email_body .= "東京都偽物市偽物町123-4\n";
		$email_body .= "電話番号 090-1234-5678\n";
		$email_body .= "Email info@privateselect.co.jp\n";
		$email_body .= "□□□□□□□□□□□□□□□□□□□\n";

		// print nl2br($email_body);


		// お客様へのメール
		$email_title = 'ご注文ありがとうございます。';
		$email_header = 'From: info@privateselect.co.jp';
		$email_body = html_entity_decode($email_body, ENT_QUOTES, 'UTF-8');
		mb_language('Japanese');
		mb_internal_encoding('UTF-8');
		mb_send_mail($email, $email_title, $email_header);


		// お店へのメール
		$email_title = 'お客様からご注文がありました。';
		$email_header = 'From: '.$email;
		$email_body = html_entity_decode($email_body, ENT_QUOTES, 'UTF-8');
		mb_language('Japanese');
		mb_internal_encoding('UTF-8');
		mb_send_mail('info@privateselect.co.jp', $email_title, $email_header);

		$cart = array();


	} catch (Exception $e) {
		print 'ただいま通信障害により大変ご迷惑をおかけしています。';
		exit();
	}

	?>
	<br>
	<a href="shop_list.php">商品一覧へ</a>
</body>
</html>