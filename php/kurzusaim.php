<html>

<body>

<?php

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";

require_once "../tools/navbar.php";

echo "<h1> ETR </h1>
<h2> Kurzusaim </h2>";

echo "<a href='../php/kurzusListaz.php'> Saját kurzusok </a>";


$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');


session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$stid = oci_parse($conn, "SELECT kurzus.kod,kurzus.nev FROM kurzus WHERE kurzus.kod IN (SELECT kurzus_kod FROM resztvesz WHERE resztvesz.hallgato_eha_kod='$username') ORDER BY kurzus.nev");
oci_execute($stid);

echo "<table border='1'>\n";

echo "<tr>";
echo "<td> Kurzuskód </td>";
echo "<td> Név </td>";



while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
	echo  "<td> <a href='kurzusleadas.php?kurzuskód=".$row["KOD"]."'> Leadás </a>  </td>";
    echo "</tr>\n";
}
echo "</table>\n";


?>
</body>
</html>