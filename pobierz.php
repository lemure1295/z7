<?php
	session_start(); 
	$user = $_SESSION['login'];
	$directory = $_SESSION['login'] .'/';
	if (isset($_GET['file'])) {
		$f = $_GET['file'];
		$file = ("$user/$f");
		$filetype=filetype($file);
		$filename=basename($file);
		header ("Content-Type: ".$filetype);
		header ("Content-Length: ".filesize($file));
		header ("Content-Disposition: attachment; filename=".$filename);
		readfile($file);
	}
?>