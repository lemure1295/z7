<?php
	session_start(); 
	$path = $_SESSION['login'] .'/' .$_SESSION['podkatalog'];
	if (isset($_GET['file'])) {
		$f = $_GET['file'];
		$file = ("$path/$f");
		$filetype=filetype($file);
		$filename=basename($file);
		header ("Content-Type: ".$filetype);
		header ("Content-Length: ".filesize($file));
		header ("Content-Disposition: attachment; filename=".$filename);
		readfile($file);
	}
?>