<?php

require "../tools/connect.php";


$targykod = $_POST["targykod"];
$nev = $_POST["nev"];
$ajanlottfelev = $_POST["ajanlottfelev"];
$oraszam = $_POST["oraszam"];
$szakid = $_POST["szakid"];


$query = oci_parse($conn, "UPDATE Targy SET nev = :nev, ajanlott_felev = :ajanlottfelev, ora_szam = :oraszam, szakid = :szakid WHERE targy_kod = :targykod");
oci_bind_by_name($query, ":nev", $nev);
oci_bind_by_name($query, ":ajanlottfelev", $ajanlottfelev);
oci_bind_by_name($query, ":oraszam", $oraszam);
oci_bind_by_name($query, ":szakid", $szakid);
oci_bind_by_name($query, ":targykod", $targykod);
$result = oci_execute($query, OCI_DEFAULT);

if ($result) {
    oci_commit($conn); // Commit Transaction
    header("location: ../php/targyListaz.php");
    exit;
} else {
    // Handle query execution error
    $error = oci_error($query);
    // Display or log the error message
    echo "Error: " . $error["message"];
}
?>