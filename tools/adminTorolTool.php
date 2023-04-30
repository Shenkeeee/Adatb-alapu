<?php

require "../tools/connect.php";
//
$ehakod = $_POST["ehakod"];

echo $ehakod . " ot torlom elv " . ' <br>';

$query = oci_parse($conn, "DELETE FROM adminisztrator WHERE eha_kod='" . $ehakod . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/adminListaz.php");

}
else{
    echo "Error.";
}