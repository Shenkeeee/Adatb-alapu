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

$ehakod = $_POST["ehakod"];
$vezeteknev = $_POST["vezeteknev"];
$keresztnev = $_POST["keresztnev"];
$email = $_POST["email"];
$pass = $_POST["pass"];

echo $ehakod . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "UPDATE felhasznalo SET vezetek = '" . $vezeteknev . "', keresztnev = '" . $keresztnev . "', email = '" . $email . "', jelszo = '" . $pass . "' WHERE eha_kod  = '" . $ehakod . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/felhasznaloListaz.php");

}
else{
    echo "Error.";
}
?>
