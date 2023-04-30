<html>
<head>
    <link href="../css/listaz.css" rel="stylesheet">
</head>

<?php

require_once "../tools/navbar.php";

require "../tools/connect.php";


session_start();
$username=$_SESSION['username'];
	
if (!isset($_SESSION["username"])) {
     header("Location: bejelentkezes.php");
	}


require "../tools/connect.php";

$stid = oci_parse($conn, 'SELECT * FROM vizsga');
oci_execute($stid);

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Azonosito" . "</td>\n";
echo "    <td>" . "Tipus" . "</td>\n";
echo "    <td>" . "Kezdet" . "</td>\n";
echo "    <td>" . "Veg" . "</td>\n";
echo "    <td>" . "Teremnev" . "</td>\n";
echo "    <td>" . "Letszam" . "</td>\n";

echo "</tr>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
	echo  "<td> <a href='kurzusfelvitel.php?vizsgakod=".$row["AZONOSITO"]."'> Jelentkezes </a>  </td>";
	//echo "<td>".$row["TARGY_KOD"]."</td>";
    echo "</tr>\n";
}
echo "</table>\n";


?>
</html>