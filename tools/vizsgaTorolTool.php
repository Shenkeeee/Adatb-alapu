<?php

require "../tools/connect.php";
//
$azonosito = $_POST["azonosito"];

echo $azonosito. " ot torlom elv " . ' <br>';

$query = oci_parse($conn, "DELETE FROM vizsga WHERE azonosito ='" . $azonosito. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/vizsgaListaz.php");

}
else{
    echo "Error.";
}