<?php

require "../tools/connect.php";

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require "../tools/connect.php";
//
$kod= $_POST["kod"];

echo $kod. " ot torlom elv " . ' <br>';

$query = oci_parse($conn, "DELETE FROM kurzus WHERE kod='" . $kod. "' OR kod='" . $username. "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Deleted Successfully.";
    header("location: ../php/kurzusListaz.php");

}
else{
    echo "Error.";
}