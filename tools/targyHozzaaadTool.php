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

$targykod = $_POST["tagykod"];
$nev = $_POST["nev"];
$ajanlottfelev = $_POST["ajanlottfelev"];
$oraszam = $_POST["oraszam"];
$szakid = $_POST["szakid"];

echo $targykod . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO targy (targy_kod, nev, ajanlott_felev, ora_szam, szakid) VALUES ('" . $targykod . "', '" . $nev .  "', '" . $ajanlottfelev .  "', '" . $oraszam .  "', '" . $szakid .  "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/targyListaz.php");

}
else{
    echo "Error.";
}
?>
