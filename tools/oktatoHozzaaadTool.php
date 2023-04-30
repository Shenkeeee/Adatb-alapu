<?php

require "../tools/connect.php";

$ehakod = $_POST["ehakod"];
$beosztas = $_POST["beosztas"];

echo $ehakod . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO oktato (eha_kod, beosztas) VALUES ('" . $ehakod . "', '" . $beosztas .  "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/oktatoListaz.php");

}
else{
    echo "Error.";
}
?>
