<?php


require "../tools/connect.php";

$azonosito = $_POST["azonosito"];
$tipus = $_POST["tipus"];
//$kezdet = $_POST["kezdet"];
//$veg = $_POST["veg"];
$teremnev = $_POST["teremnev"];
$letszam = $_POST["letszam"];
$targy_kod = $_POST["targy_kod"];

$kezdet_date = $_POST['kezdet_date'];
$kezdet_hour = $_POST['kezdet_hour'];
$kezdet_minute = $_POST['kezdet_minute'];
$kezdet = $kezdet_date . ' ' . str_pad($kezdet_hour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($kezdet_minute, 2, '0', STR_PAD_LEFT) . ':00';

$veg_date = $_POST['veg_date'];
$veg_hour = $_POST['veg_hour'];
$veg_minute = $_POST['veg_minute'];
$veg = $veg_date . ' ' . str_pad($veg_hour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($veg_minute, 2, '0', STR_PAD_LEFT) . ':00';


echo $azonosito . " ot adom hozza elv " . ' <br>';

$query = oci_parse($conn, "INSERT INTO vizsga (azonosito, tipus, kezdet, veg, teremnev, letszam, targy_kod) 
                            VALUES ('" . $azonosito . "', '" . $tipus . "', TO_DATE('" . $kezdet . "', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('" . $veg . "', 'YYYY-MM-DD HH24:MI:SS'), '" . $teremnev . "', " . $letszam . ", '" . $targy_kod . "')");

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
