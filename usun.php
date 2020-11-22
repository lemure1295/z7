<?php
	session_start(); 
	$user = $_SESSION['login'];
	$directory = $_SESSION['login'] .'/';
	if (isset($_GET['usun'])) {
		$f = $_GET['usun'];
		$file = ("$user/$f");
		$filetype=filetype($file);
		$filename=basename($file);
		unlink($file);
		header ('Location: wyswietl.php');	
	}
?>