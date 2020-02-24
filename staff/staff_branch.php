<?php
	if (isset($_POST['add']) == true) {
		header('Location: staff_add.php');
		exit();
	}
	elseif (isset($_POST['staffcode']) == false) {

		header('Location: staff_ng.php');
		exit();

	}elseif (isset($_POST['disp']) == true) {

		$staff_code = $_POST['staffcode'];
		header('Location: staff_disp.php?staffcode='.$staff_code);
		exit();

	}elseif (isset($_POST['edit']) == true) {

		$staff_code = $_POST['staffcode'];
		header('Location: staff_edit.php?staffcode='.$staff_code);
		exit();

	}elseif (isset($_POST['delete']) == true) {

		$staff_code = $_POST['staffcode'];
		header('Location: staff_delete.php?staffcode='.$staff_code);
		exit();

	}
?>