<?php

require "../tools/connect.php";

$szakid = $_POST["szakid"];
$szaknev = $_POST["szaknev"];

echo $szakid . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO szak (szakid, szaknev) VALUES ('" . $szakid . "', '" . $szaknev .  "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/szakListaz.php");

}
else{
	
	echo "<script> alert('A megadott szakid már létezik. Kérlek, adj meg egy egyedi szakid-t.!');window.location='../php/szakHozzaad.php' </script>";
}
?>
