<?php

require "../tools/connect.php";
//
$teremnev= $_POST["teremnev"];

echo $teremnev. " ot torlom elv " . ' <br>';

$query = oci_parse($conn, "DELETE FROM terem WHERE teremnev='" . $teremnev. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/teremListaz.php");

}
else{
    echo "Error.";
}