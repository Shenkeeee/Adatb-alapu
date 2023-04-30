<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php
require "../tools/connect.php";


require_once "../tools/navbar.php";

echo "<h1> ETR </h1>
<h2> Kurzusaim </h2>";

echo "<a href='../php/kurzusListaz.php'> Saját kurzusok </a>";


session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
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