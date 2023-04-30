<?php


require "../tools/connect.php";

$azonosito = $_POST["azonosito"];
$tipus = $_POST["tipus"];
$kezdet = $_POST["kezdet"];
$veg = $_POST["veg"];
$teremnev = $_POST["teremnev"];
$letszam = $_POST["letszam"];
$targy_kod = $_POST["targy_kod"];

echo $azonosito . " ot adom hozza elv " . ' <br>';

// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO vizsga (azonosito , tipus, kezdet, veg, teremnev,letszam, targy_kod) VALUES ('" . $azonosito . "', '" . $tipus . "', '" . $kezdet . "', '" . $veg . "', '" . $teremnev ."', '" . $letszam . "', '" . $targy_kod . "')");

//$query = oci_parse($conn, "INSERT INTO felhasznalo VALUES ('" . $ehakod . "')");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/vizsgaListaz.php");

}
else{
    echo "Error.";
}
?>
