<?php
	session_start();
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$_SESSION['login'] = $_POST['user'];
	$udane = '0';
	$dbhost="mysql01.lemure1295.beep.pl"; $dbuser="lemure1295"; $dbpassword="Walka!295"; $dbname="ruszkowski_baza";
	$link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	if(!$link) { 
		echo"B³¹d: ". mysqli_connect_errno()." ".mysqli_connect_error(); 
	} 
	mysqli_query($link, "SET NAMES 'utf8'"); 
	$result = mysqli_query($link, "SELECT * FROM user WHERE login='$user'"); 
	$rekord = mysqli_fetch_array($result); 
	if(!$rekord) {
		mysqli_close($link);
		echo "Brak uzytkownika o takim loginie !"; 
	}
	else {
		$dbhost="mysql01.lemure1295.beep.pl"; $dbuser="lemure1295"; $dbpassword="Walka!295"; $dbname="ruszkowski_baza";
		$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		$rezultat = mysqli_query($polaczenie, "SELECT * FROM logi WHERE login = '$user'") or die ("B³¹d zapytania do bazy: $dbname");
		while ($wiersz = mysqli_fetch_array ($rezultat)) {
			$udane = $wiersz[4];
		}
		if($udane < 2) {
			if($rekord['haslo']==$pass) {
				try {
					$udane = '0';
					$dbhost="mysql01.lemure1295.beep.pl"; $dbuser="lemure1295"; $dbpassword="Walka!295"; $dbname="ruszkowski_baza";
					$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
						if ($polaczenie->connect_errno!=0) {
							throw new Exception(mysqli_connect_errno());
						}
						else {
							if ($polaczenie->query("INSERT INTO logi (login, IP, udane) VALUES ('$user', '$ipaddress', '$udane')")) {
								$_SESSION['udanelogowanie']=true;
								$_SESSION['login'] = $_POST['user'];
								header ('Location: wyswietl.php');	
							}
							else {
								throw new Exception($polaczenie->error);
							}
							$polaczenie->close();
						}
				}
				catch(Exception $e) {
					echo '<span style="color:red;">B³¹d serwera!</span>';
					echo '<br />Informacja: '.$e;
				}
			}
			else {		
				$dbhost="mysql01.lemure1295.beep.pl"; $dbuser="lemure1295"; $dbpassword="Walka!295"; $dbname="ruszkowski_baza";
				$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
				if ($polaczenie->connect_errno!=0) {
					throw new Exception(mysqli_connect_errno());
				}
				else {	
					++$udane;
					if ($polaczenie->query("INSERT INTO logi (login, IP, udane) VALUES ('$user', '$ipaddress', '$udane')")) {
						$_SESSION['udanelogowanie']=false;
					}
					else {
						throw new Exception($polaczenie->error);
					}
					$polaczenie->close();
				}
				mysqli_close($link);
				echo "Bledne haslo!";
			}
		}
		else {
			$dbhost="mysql01.lemure1295.beep.pl"; $dbuser="lemure1295"; $dbpassword="Walka!295"; $dbname="ruszkowski_baza";
			$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
			$rezultat2 = mysqli_query($polaczenie, "SELECT * FROM logi WHERE login = '$user'") or die ("B³¹d zapytania do bazy: $dbname");
			while ($wiersz = mysqli_fetch_array ($rezultat2)) {
				$czas = $wiersz[3];
			}
			$dattTime = new DateTime();
			$dateTime2 = new DateTime($czas);
			$interval = $dattTime->diff($dateTime2);
			$roznica = $interval->format('%i');
			if ($roznica < 1) {
				echo "Przekroczono ilosc prob. Konto zostalo zablokowane na minute.";
			}
			else {
				$udane = 0;
				if ($polaczenie->query("INSERT INTO logi (login, IP, udane) VALUES ('$user', '$ipaddress', '$udane')")) {
					$_SESSION['udanelogowanie']=true;
					$_SESSION['login'] = $_POST['user'];
					header ('Location: wyswietl.php');	
				}
				else {
					throw new Exception($polaczenie->error);
				}
			}
		}
	}
?>

