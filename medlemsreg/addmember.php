<?php $hostUrl = 'mysql10.000webhost.com';
$userName = 'a2086984_sqluser';
$password = 'pass000';
// anslut till db
$connectID = mysql_connect($hostUrl, $userName, $password) or die("Sorry, can't connect to database");

//välj db att läsa ifrån
mysql_select_db("a2086984_medlem", $connectID) or die("Unable to select database");

//skapa variabler om formuläret har skickats
if ($_POST['submitted'])  {
	$fnamn=($_POST['foernamn']);
	$enamn=($_POST['efternamn']);
	$telefon=($_POST['telefon']);
	
//ta bort mellanslag
if (get_magic_quotes_gpc() ) {
	$fnamn=stripslashes($fnamn);
	$enamn=stripslashes($enamn);
	$telefon=stripslashes($telefon);
	}

//skapa array för felmeddelanden
	$error_msg=array();

//kolla om det finns tomma fält någonstans

if ($fnamn=="") {

$error_msg[]="Var god och ange ett förnamn!";
}

if ($enamn=="") {

$error_msg[]="Var god och ange ett efternamn!";

}
if ($telefon=="") { 

$error_msg[]="Var god och ange ett telefonnummer!";

}

//om inga fel förekommer skriv till db och hämta bekräftelse-sidan
if  (!$error_msg) {
	mysql_query ("INSERT into medlemsreg (fnamn, enamn, telefon) VALUES ('$fnamn', '$enamn', '$telefon')", $connectID)
  or die ("Unable to insert record into database");
	header ('Location: form_confirm.php');

   exit();
   }
}
?>

<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8" />
		<title>Lägg till medlem</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<style type="text/css">
			body {
				font-family: verdana, arial, sans-serif;
				font-size: 80%
			}
			h3 {
				padding: 10px 0 0 0;
				margin: 0;
			}
			label {
				display: block;
				margin: 8px 0 2px 0;
			}
			input[type="submit"] {
				display: block;
				margin-top: 8px;
			}
		</style>
	</head>

	<body>
		<h3>Lägg upp en medlem i registret</h3>
		<?php
		if ($error_msg) {
			echo "<ul>\n";
			// öppna en lista
			foreach ($error_msg as $err) {
				// skriv ut eventuella fel från arrayen
				echo "<li>" . $err . "</li>\n";
			}
			echo "</ul>\n";
			// stäng listan
		}
		?>

		<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
			<p>
				<!--Förnamn-->
				<label for="foernamn">Förnamn</label>
				<input name="foernamn" type="text" size="35" id="foernamn" value="" />
				<!--Efternamn-->
				<label for="efternamn">Efternamn</label>
				<input name="efternamn" type="text" size="35" id="efternamn" value="" />
				<!--Telefon-->
				<label for="telefon">Telefon</label>
				<input name="telefon" type="text" size="35" id="telefon" value="" />
				<input type="submit" value="Lägg upp" name="submitted" />
			</p>
		</form>

		<br />
		<a href="index.php">Avbryt och återgå till medlemsregistret</a>
	</body>
</html>
<?php
// stäng anslutning till db
mysql_close($connectID);
?>
