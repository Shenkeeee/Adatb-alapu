<?php

require "../tools/connect.php";

$kod = $_POST["kod"];
$nev = $_POST["nev"];
$kredit = $_POST["kredit"];
$oraszam = $_POST["oraszam"];
$nap = $_POST["nap"];
$kezdet = $_POST["kezdet"];
$veg = $_POST["veg"];
$teremnev = $_POST["teremnev"];
$targy_kod = $_POST["targy_kod"];

echo $kod . " ot adom hozza elv " . ' <br>';


// Prepare and execute the SQL statement
//$query = "UPDATE kurzus SET teremnev = :teremnev, kredit = :kredit, oraszam = :oraszam, nap = :nap, kezdet = TO_DATE(:kezdet, 'YYYY-MM-DD'), veg = TO_DATE(:veg, 'YYYY-MM-DD'), targy_kod = :targy_kod WHERE kod = :kod";
$query = oci_parse($conn, "UPDATE kurzus SET nev = '" . $nev . "', 
kredit = '" . $kredit . "', 
oraszam = '" . $oraszam . "', 
nap = '" . $nap . "' ,
kezdet = TO_DATE('" . $kezdet . "', 'YYYY-MM-DD') ,
veg = TO_DATE('" . $veg . "', 'YYYY-MM-DD') ,
teremnev = '" . $teremnev . "' ,
targy_kod = '" . $targy_kod . "' 
WHERE kod  = '" . $kod . "'");
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
