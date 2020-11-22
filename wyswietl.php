<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<title>Ruszkowski</title>
	<meta http-equiv="refresh" content="1000000" />
</head>
<body> 
<?php session_start(); 
	$user = $_SESSION['login'];
	$dbhost="mysql01.lemure1295.beep.pl"; $dbuser="lemure1295"; $dbpassword="Walka!295"; $dbname="ruszkowski_baza";
	$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	$rezultat = mysqli_query($polaczenie, "SELECT * FROM logi WHERE login = '$user' AND udane = '3' OR udane = '2' OR udane = '1' ORDER BY id DESC LIMIT 1") or die ("Błąd zapytania do bazy: $dbname");
	while ($wiersz = mysqli_fetch_array ($rezultat)){
		$data = $wiersz[3];
		echo "<p> <font color=black size='4pt'> Ostatnie nieudane logowanie: </font> <font color=red size='4pt'>$data</font></p>";
	}
?> 		
<b><h2><center>Twoja chmura!</h2></b><br><br>	
Wybierz plik do przesłania: 			
<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data"> 
	<input type="file" name="plik"/> <input type="submit" value="Wyślij plik"/>
</form>
Stwórz nowy katalog <br> 
<form method="post" action="katalog.php">
	Wpisz nazwę katalogu:<input type="text" name="katalog" maxlength="20" size="20"><br>
	<input type="submit" value="Send"/>
</form>
Twoje podkatalogi: <br>
</body> 
</html>
<?php
session_start(); 
$user = $_SESSION['login'];
$directory = $_SESSION['login'] .'/';

foreach(glob($directory.'*', GLOB_ONLYDIR) as $dir) {
    $dir = str_replace($directory, '', $dir);
	echo "<a href='podkatalog.php?file=$dir'>$dir</a>"."<br>";
}
?>
<br>
Twoje pliki:
<br>
<?php
$files = scandir($directory); 
foreach($files as $file)
{
    if(is_file($directory.$file)){
		echo "<a href='http://www.lemure1295.beep.pl/z7/$directory" . "$file'>$file</a>"."  ";	
		echo "<a href='pobierz.php?file=$file'>Pobierz</a>"; echo "  "  ;
		echo "<a href='usun.php?usun=$file'>Usun</a>"."<br>";
	}
}

?>

