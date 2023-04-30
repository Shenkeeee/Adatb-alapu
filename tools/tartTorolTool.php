<?php

require "../tools/connect.php";
//
$ehakod = $_POST["ehakod"];
$kurzuskod = $_POST["kurzuskod"];

echo $ehakod. " ot torlom elv meg kurzuskod " . $kurzuskod . ' <br>';

$query = oci_parse($conn, "DELETE FROM tart WHERE oktato_eha_kod ='" . $ehakod. "' AND kurzus_kod = '" . $kurzuskod. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/tartListaz.php");

}
else{
    echo "Error.";
}