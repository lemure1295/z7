<?php
	session_start(); 
	$path = $_SESSION['login'] .'/' .$_SESSION['podkatalog'];
	if (isset($_GET['usun'])) {
		$f = $_GET['usun'];
		$file = ("$path/$f");
		$filetype=filetype($file);
		$filename=basename($file);
		unlink($file);
		header ('Location: wyswietl.php');	
	}
?>