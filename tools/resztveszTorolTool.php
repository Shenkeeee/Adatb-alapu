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
$ehakod= $_POST["ehakod"];
$kurzuskod= $_POST["kurzuskod"];

echo $ehakod. " ot torlom elv meg kurzuskod " . $kurzuskod . ' <br>';

$query = oci_parse($conn, "DELETE FROM resztvesz WHERE hallgato_eha_kod ='" . $ehakod. "' AND kurzus_kod = '" . $kurzuskod. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/resztveszListaz.php");

}
else{
    echo "Error.";
}