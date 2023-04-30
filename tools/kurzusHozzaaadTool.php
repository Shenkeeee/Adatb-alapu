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

$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$kod = $_POST["kod"];
$nev = $_POST["nev"];
$kredit= $_POST["kredit"];
$oraszam = $_POST["oraszam"];
$nap = $_POST["nap"];
$kezdet = $_POST["kezdet"];
$veg = $_POST["veg"];
$teremnev = $_POST["teremnev"];
$targykod = $_POST["targykod"];

echo $targykod . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO kurzus (kod, nev, kredit, oraszam, nap,kezdet,veg,teremnev,targy_kod) VALUES ('" . $kod . "', '" . $nev .  "', '" . $kredit .  "', '" . $oraszam .  "', '" . $nap .  "', '" . $kezdet .  "', '" . $veg .  "', '" . $teremnev .  "', '" . $targykod.  "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/kurzusListaz.php");

}
else{
    echo "Error.";
}
?>
