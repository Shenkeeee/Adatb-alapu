<?php


require "../tools/connect.php";

$ehakod = $_POST["ehakod"];

echo $ehakod . " ot adom hozza elv " . ' <br>';

$query = oci_parse($conn, "INSERT INTO adminisztrator VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/adminListaz.php");

}
else{
    echo "Error.";
}
?>
