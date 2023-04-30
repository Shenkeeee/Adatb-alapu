<html>

<body>

<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require "../tools/connect.php";

require_once "../tools/navbar.php";

echo "<h1> ETR </h1>
<h2> Vizsgáim </h2>";

echo "<a href='../php/vizsgaListaz.php'> Saját vizsga </a>";


require "../tools/connect.php";


$stid = oci_parse($conn, "SELECT vizsga.azonosito,vizsga.tipus,vizsga.kezdet,vizsga.veg,vizsga.teremnev,vizsga.letszam FROM vizsga WHERE azonosito IN (SELECT azonosito FROM vizsgazik WHERE eha_kod='$username')");
oci_execute($stid);

echo "<table border='1'>\n";

echo "<tr>";
echo "<td> Azonosító </td>";
echo "<td> Típus </td>";
echo "<td> Kezdet </td>";
echo "<td> Vég </td>";
echo "<td> Teremnev </td>";
echo "<td> Létszám </td>";
echo "<td> Leadás </td>";




while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
	echo  "<td> <a href='kurzusleadas.php?vizsgakod=".$row["AZONOSITO"]."'> Leadás </a>  </td>";
    echo "</tr>\n";
}
echo "</table>\n";


?>
</body>
</html>