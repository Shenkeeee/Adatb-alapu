<html>
<head>
    <link href="../css/listaz.css" rel="stylesheet">
</head>

<h1> Tárgyak </h1>

<?php

require_once "../tools/navbar.php";
require "../tools/connect.php";



session_start();
$username=$_SESSION['username'];
	
if (!isset($_SESSION["username"])) {
     header("Location: bejelentkezes.php");
}


if(isset($_GET['kurzuskód'])) { 
$kurzuskód = $_GET['kurzuskód'];

$stid = oci_parse($conn, "SELECT resztvesz.kurzus_kod,hallgato.eha_kod,felhasznalo.vezetek,felhasznalo.keresztnev,resztvesz.erdemjegy FROM hallgato,resztvesz,felhasznalo WHERE hallgato.eha_kod=resztvesz.hallgato_eha_kod AND hallgato.eha_kod=felhasznalo.eha_kod AND resztvesz.kurzus_kod='$kurzuskód'");
oci_execute($stid);

echo "<table border='1'>\n";

echo "<tr>";
echo "<td> Kurzuskód </td>";
echo "<td> EHA_kód </td>";
echo "<td> Vezetéknév </td>";
echo "<td> Keresztnév </td>";
echo "<td> Érdemjegy </td>";
echo "<td> Jegymódosítás </td>";
echo "</tr>";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
	echo " <td> <form action='jegyszerkesztes.php' method='POST'>
		<input type='hidden' value=".$row['EHA_KOD']." name='eha'> </input>
		<input type='hidden' value=".$row['KURZUS_KOD']." name='kurzuskod'> </input>
		<input type='number' min='1' max='5' name='jegy'> </input>
		<input type='submit' name='jegym' value='Módosítás'> </input>
		</form> </td>";
    echo "</tr>\n";
}
echo "</table>\n";
}


?>
</html>

