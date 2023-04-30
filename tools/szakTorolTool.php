<?php

require "../tools/connect.php";
//
$szakid = $_POST["szakid"];

echo $szakid . " ot torlom elv " . ' <br>';

$query = oci_parse($conn, "DELETE FROM szak WHERE szakid='" . $szakid . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/szakListaz.php");

}
else{
    echo "Error.";
}