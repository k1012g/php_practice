<?php
	session_start();
	session_regenerate_id(true);

	require_once('../common/common.php');

	$post = sanitize($_POST);

	$max = $post['max'];

	for ($i = 0; $i < $max; $i++) {
		$qty[] = $post['qty'.$i];
	}

	$_SESSION['qty'] = $qty;

	header('Location: shop_cartlook.php');
	exit();
?>