<?php

require "../tools/connect.php";
//
$ehakod = $_POST["ehakod"];
$datum = $_POST["datum"];

echo $ehakod . " ot torlom elv es a datum " . $datum . ' <br>';

$query = oci_parse($conn, "DELETE FROM uzenet WHERE eha_kod='" . $ehakod . "' AND datum='" . $datum . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/uzenetListaz.php");

}
else{
    echo "Error.";
}