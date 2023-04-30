<?php

require "../tools/connect.php";

//
$ehakod = $_POST["ehakod"];

echo $ehakod . " ot torlom elv " . ' <br>';

//meg nem mukodik mert elotte minden mast is torolni kell
$query = oci_parse($conn, "DELETE FROM felhasznalo WHERE eha_kod='" . $ehakod . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/felhasznaloListaz.php");

}
else{
    echo "Error.";
}