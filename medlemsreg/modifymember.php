<?php $hostUrl = 'mysql10.000webhost.com';
$userName = 'a2086984_sqluser';
$password = 'pass000';
// anslut till db
$connectID = mysql_connect($hostUrl, $userName, $password) or die("Sorry, can't connect to database");

//välj db att läsa ifrån
mysql_select_db("a2086984_medlem", $connectID) or die("Unable to select database");

//skapa variabler om formuläret har skickats
if ((!$_POST['submitted']) && ($_GET['modify_id'])) {
       //medlemsreg har skickat ett medlemsid som skall uppdateras
			 $id = ($_GET['modify_id']);
			 	$this_Record = mysql_query("SELECT * FROM medlemsreg WHERE medlemsid = '$id'", $connectID)
				or die ("Can't read the this record.");
$record_data = mysql_fetch_array($this_Record, MYSQL_ASSOC);

} elseif  (($_POST['submitted']) && ($_GET['modify_id'])) {
       // formuläret har skickats med uppdaterade värden	
			$fnamn=($_POST['foernamn']);
			$enamn=($_POST['efternamn']);
			$telefon=($_POST['telefon']);
			$id = ($_GET['modify_id']);
			
		$success = mysql_query("UPDATE medlemsreg SET fnamn = '$fnamn', enamn = '$enamn', telefon = '$telefon' WHERE medlemsid='$id'", $connectID);
			 if ($success) {
			 header ('Location: form_confirm3.php');
			 }
}

?>

<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8" />
		<title>Ändra en medlem</title>
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
		<h3>Ändra en medlem i registret</h3>
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
				<input name="foernamn" type="text" size="35" id="foernamn" value="<?php print $record_data['fnamn'] ?>" />
				<!--Efternamn-->
				<label for="efternamn">Efternamn</label>
				<input name="efternamn" type="text" size="35" id="efternamn" value="<?php print $record_data['enamn'] ?>" />
				<!--Telefon-->
				<label for="telefon">Telefon</label>
				<input name="telefon" type="text" size="35" id="telefon" value="<?php print $record_data['telefon'] ?>" />
				<input type="submit" value="Ändra" name="submitted" />
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