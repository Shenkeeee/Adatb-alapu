<?php

require "../tools/connect.php";

//
$ehakod = $_POST["ehakod"];
$azonosito = $_POST["azonosito"];

echo $ehakod. " ot torlom elv meg azonosito " . $azonosito. ' <br>';

$query = oci_parse($conn, "DELETE FROM vizsgaztat WHERE oktato_eha_kod ='" . $ehakod. "' AND azonosito = '" . $azonosito. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/vizsgaztatListaz.php");

}
else{
    echo "Error.";
}