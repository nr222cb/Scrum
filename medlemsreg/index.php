<?php $hostUrl = 'mysql10.000webhost.com';
$userName = 'a2086984_sqluser';
$password = 'pass000';
// anslut till db
$connectID = mysql_connect($hostUrl, $userName, $password) or die("Sorry, can't connect to database");

//välj db att läsa ifrån
mysql_select_db("a2086984_medlem", $connectID) or die("Unable to select database");
?>

<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8" />
		<title>Medlemsregister</title>
		<style type="text/css">
			body {
				font-family: verdana, arial, sans-serif;
				font-size: 80%
			}
			h3 {
				padding: 10px 0 0 0;
				margin: 0;
			}
			table {
				border: 0px
			}
			th {
				padding: 4px;
				vertical-align: top;
				border-bottom: 3px solid #CCC;
				border-top: 0px;
				border-left: 0px;
				border-right: 0px;
			}
			td {
				padding: 4px;
				vertical-align: top;
				border-bottom: 1px solid #CCC;
				border-top: 0px;
				border-left: 0px;
				border-right: 0px;
			}
		</style>
	</head>
	<body>
		<h3>Medlemsregister</h3>
		<p>
			<a href="???.php">Lägg upp en medlem i registret</a>
		</p>
		<?php
		//hämta data från db
		$myResult = mysql_query("SELECT * FROM medlemsreg", $connectID) or die("Unable to select item by ID from database");
		//bygg tabell
		print '<table border="1">' . "\n";
		print '<tr>' . "\n";
		print '<th>' . 'Förnamn' . '</th>' . "\n";
		print '<th>' . 'Efternamn' . '</th>' . "\n";
		print '<th>' . 'Telefon' . '</th>' . "\n";
		print '<th>' . 'Ändra' . '</th>' . "\n";
		print '<th>' . 'Radera' . '</th>' . "\n";
		print '</tr>' . "\n";
		while ($row = mysql_fetch_array($myResult, MYSQL_ASSOC)) {
			print '<tr>' . "\n";
			print '<td>' . $row['fnamn'] . '</td>' . "\n";
			print '<td>' . $row['enamn'] . '</td>' . "\n";
			print '<td>' . $row['telefon'] . '</td>' . "\n";
			
			print '</tr>' . "\n";
		}
		print '</table>' . "\n";
		?>
	</body>
</html>
<?php
// stäng anslutning till db
mysql_close($connectID);
?>