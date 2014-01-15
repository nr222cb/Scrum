<?php $hostUrl = 'mysql10.000webhost.com';
$userName = 'a2086984_sqluser';
$password = 'pass000';
// anslut till db
$connectID = mysql_connect($hostUrl, $userName, $password) or die("Sorry, can't connect to database");

//välj db att läsa ifrån
mysql_select_db("a2086984_medlem", $connectID) or die("Unable to select database");

//hämta upp det fältet som skall tas bort
if ($_GET['delete_id']) {
	$id = ($_GET['delete_id']);

	$success = mysql_query("DELETE FROM medlemsreg WHERE medlemsid = $id", $connectID) or die("Unable to delete record from database");

	//gå vidare till bekräftelse om borttagning
	if ($success) {
		header('Location: form_confirm2.php');

		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8" />
		<title>Medlemsregister</title>
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
			<a href="addmember.php">Lägg upp en medlem i registret</a>
		</p>
		<?php
		//hämta data från db
		$myResult = mysql_query("SELECT * FROM medlemsreg", $connectID) or die("Unable to select item by ID from database");
		//bygg tabell
		print '<table>' . "\n";
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
			$id = $row['medlemsid'];
			print '<td><a href="modifymember.php?modify_id=' . $id . '">Ändra</td>';
			print '<td><a href="';
			print($_SERVER['PHP_SELF']);
			print '?delete_id=' . $id . '">Radera</a></td>';
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