<?php

require "../tools/connect.php";

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
