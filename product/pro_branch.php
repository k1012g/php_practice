<?php
	if (isset($_POST['add']) == true) {
		header('Location: pro_add.php');
		exit();
	}
	elseif (isset($_POST['procode']) == false) {

		header('Location: pro_ng.php');
		exit();

	}elseif (isset($_POST['disp']) == true) {

		$pro_code = $_POST['procode'];
		header('Location: pro_disp.php?procode='.$pro_code);
		exit();

	}elseif (isset($_POST['edit']) == true) {

		$pro_code = $_POST['procode'];
		header('Location: pro_edit.php?procode='.$pro_code);
		exit();

	}elseif (isset($_POST['delete']) == true) {

		$pro_code = $_POST['procode'];
		header('Location: pro_delete.php?procode='.$pro_code);
		exit();

	}
?>