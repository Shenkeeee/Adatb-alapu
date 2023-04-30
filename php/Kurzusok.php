<html xmlns="http://www.w3.org/1999/html">
<head>
<link href="../css/listaz.css" rel="stylesheet">
</head>
<body>
<?php

echo "<h1> ETR </h1>";
echo "<h2>A tárgy kurzusai</h2>";
require "../tools/connect.php";


	session_start();
	$username=$_SESSION['username'];

	if (!isset($_SESSION["username"])) {
        header("Location: bejelentkezes.php");
    }


		if(isset($_GET['tárgykód'])) {
		$tárgykód = $_GET['tárgykód'];


		$stid = oci_parse($conn, "SELECT * FROM kurzus WHERE targy_kod='$tárgykód'");
		oci_execute($stid);

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Kod" . "</td>\n";
echo "    <td>" . "Nev" . "</td>\n";
echo "    <td>" . "Kredit" . "</td>\n";
echo "    <td>" . "Oraszam" . "</td>\n";
echo "    <td>" . "Nap" . "</td>\n";
echo "    <td>" . "Kezdet" . "</td>\n";
echo "    <td>" . "Veg" . "</td>\n";
echo "    <td>" . "Teremnev" . "</td>\n";
echo "    <td>" . "Targykod" . "</td>\n";
echo "    <td>" . "Felvesz" . "</td>\n";
echo "</tr>\n";

	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		echo "<tr>\n";
		foreach ($row as $item) {
			echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		}
		echo  "<td> <a href='kurzusfelvitel.php?kurzuskód=".$row["KOD"]."'> Felvesz </a>  </td>";
		echo "</tr>\n";
	}
	echo "</table>\n";


		}



?>
</body>
</html>