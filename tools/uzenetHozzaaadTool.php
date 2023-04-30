<?php

require "../tools/connect.php";

$tartalom = $_POST["tartalom"];
$ehakod = $_POST["ehakod"];
//$datum = $_POST["datum"];

$datum = date('Y-m-d H:i:s');
$oracleFormattedDate = "TO_DATE('$datum', 'YYYY-MM-DD HH24:MI:SS')";

echo $ehakod . " ot adom hozza elv. " . $oracleFormattedDate . " a datum" . ' <br>';
//echo $ehakod . " ot adom hozza elv. " . $oracleFormattedDate . " a datum" . ' <br>';
//echo $ehakod . " ot adom hozza elv. " . $oracleFormattedDate ." a datum" . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO uzenet (eha_kod, tartalom, datum) VALUES ('" . $ehakod . "', '" . $tartalom . "', " . $oracleFormattedDate . ")");

$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/forum.php");

}
else{
    echo "Error.";
}
?>
