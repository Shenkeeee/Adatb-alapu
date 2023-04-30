<?php

require "../tools/connect.php";

$teremnev = $_POST["teremnev"];
$gepes = $_POST["gepes"];
$fero_hely = $_POST["ferohely"];

echo $teremnev . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO terem (teremnev, gepes, fero_hely) VALUES ('" . $teremnev . "', '" . $gepes ."', '" . $fero_hely .   "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/teremListaz.php");

}
else{
    echo "Error.";
}
?>
