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


// Prepare and execute the SQL statement
//$query = "UPDATE kurzus SET teremnev = :teremnev, kredit = :kredit, oraszam = :oraszam, nap = :nap, kezdet = TO_DATE(:kezdet, 'YYYY-MM-DD'), veg = TO_DATE(:veg, 'YYYY-MM-DD'), targy_kod = :targy_kod WHERE kod = :kod";
$query = oci_parse($conn, "UPDATE vizsga SET tipus = '" . $tipus . "', 
kezdet = TO_DATE('" . $kezdet . "', 'YYYY-MM-DD') ,
veg = TO_DATE('" . $veg . "', 'YYYY-MM-DD') ,
teremnev = '" . $teremnev . "', 
letszam = '" . $letszam . "', 
targy_kod = '" . $targy_kod . "' 
WHERE azonosito  = '" . $azonosito . "'");
$result = oci_execute($query, OCI_DEFAULT);
if($result)
{
    oci_commit($conn); //*** Commit Transaction ***//
    echo "Data Added succesfully.";
    header("location: ../php/kurzusListaz.php");

}
else{
    echo "Error.";
}
?>
