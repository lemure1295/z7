<?php
	session_start(); 
	$user = $_SESSION['login'];
	$directory = $_SESSION['login'] .'/';
	if (isset($_POST['katalog'])) {
		$f = $_POST['katalog'];
		$file = ("$user/$f");
		mkdir($file);
		header ('Location: wyswietl.php');
	}
?>