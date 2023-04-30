<?php

require "../tools/connect.php";

$ehakod = $_POST["ehakod"];
$atlag = $_POST["atlag"];
$szak = $_POST["szak"];

echo $ehakod . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "UPDATE hallgato SET atlag = '" . $atlag . "', szakid = '" . $szak . "' WHERE eha_kod  = '" . $ehakod . "'");
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
