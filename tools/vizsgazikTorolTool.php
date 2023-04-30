<?php

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";

$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
//
$ehakod = $_POST["ehakod"];
$azonosito = $_POST["azonosito"];

echo $ehakod. " ot torlom elv meg azonosito " . $azonosito. ' <br>';

$query = oci_parse($conn, "DELETE FROM vizsgazik WHERE eha_kod ='" . $ehakod. "' AND azonosito = '" . $azonosito. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/vizsgazikListaz.php");

}
else{
    echo "Error.";
}