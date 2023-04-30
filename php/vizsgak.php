<html>
<head>
    <link href="../css/listaz.css" rel="stylesheet">
</head>

<?php

require_once "../tools/navbar.php";

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";


session_start();
$username=$_SESSION['username'];
	
if (!isset($_SESSION["username"])) {
     header("Location: bejelentkezes.php");
	}


$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

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