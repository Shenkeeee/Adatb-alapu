<?php

require "../tools/connect.php";
//
$targykod= $_POST["targykod"];

echo $targykod. " ot torlom elv " . ' <br>';

$query = oci_parse($conn, "DELETE FROM targy WHERE targy_kod='" . $targykod . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/targyListaz.php");

}
else{
    echo "Error.";
}