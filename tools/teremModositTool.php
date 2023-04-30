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


$teremnev = $_POST["teremnev"];
$gepes = $_POST["gepes"];
$ferohely = $_POST["ferohely"];


$query = oci_parse($conn, "UPDATE terem SET gepes = :gepes, fero_hely = :ferohely WHERE teremnev = :teremnev");
oci_bind_by_name($query, ":gepes", $gepes);
oci_bind_by_name($query, ":ferohely", $ferohely);
oci_bind_by_name($query, ":teremnev", $teremnev);
$result = oci_execute($query, OCI_DEFAULT);

if ($result) {
    oci_commit($conn); // Commit Transaction
    header("location: ../php/teremListaz.php");
    exit;
} else {
    // Handle query execution error
    $error = oci_error($query);
    // Display or log the error message
    echo "Error: " . $error["message"];
}
?>