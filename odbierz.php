<?php 
	session_start(); 
	$user = $_SESSION['login'];
	if (is_uploaded_file($_FILES['plik']['tmp_name'])) { 
		echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>'; 
		move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .'z7/' .$_SESSION['login'] .'/' .$_FILES['plik']['name']  ); 
		header ('Location: wyswietl.php');	
	} 
	else {
		echo 'B³¹d przy przesy³aniu danych!';
	} 
?>