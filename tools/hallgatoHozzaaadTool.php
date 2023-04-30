<?php

require "../tools/connect.php";

$ehakod = $_POST["ehakod"];
$atlag = $_POST["atlag"];
$szak = $_POST["szak"];

echo $ehakod . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO hallgato (eha_kod, atlag, szakid) VALUES ('" . $ehakod . "', '" . $atlag .  "', '" . $szak .  "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/hallgatoListaz.php");

}
else{
    echo "Error.";
}
?>
