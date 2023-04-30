<?php


session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
    header("Location: bejelentkezes.php");
}

require "../tools/connect.php";

$nev = $_POST["nev"];
$kod = $_POST["kod"];
$kredit = $_POST["kredit"];
$oraszam = $_POST["oraszam"];
$nap = $_POST["nap"];
$kezdet = $_POST["kezdet"];
$veg = $_POST["veg"];
$teremnev = $_POST["teremnev"];
$targy_kod = $_POST["targy_kod"];
$jelentkezokszama = $_POST["jelentkezokszama"];
//$zart = $_POST["zart"];


$oktato_EHA_kod= $username;

echo $kredit . " ot adom hozza elv " . ' <br>';

$zart = 1;

$query = oci_parse($conn, "INSERT INTO kurzus (kod, nev, kredit, oraszam, nap, kezdet, veg, teremnev, targy_kod, jelentkezok_szama, zart) 
                            VALUES (:kod, :nev, :kredit, :oraszam, :nap, TO_DATE(:kezdet, 'YYYY-MM-DD'), TO_DATE(:veg, 'YYYY-MM-DD'), :teremnev, :targy_kod, :jelentkezok_szama, :zart)");

$kurzus_kod = $kod; // replace with the actual kurzus_kod value

oci_bind_by_name($query, ":kod", $kod);
oci_bind_by_name($query, ":nev", $nev);
oci_bind_by_name($query, ":kredit", $kredit);
oci_bind_by_name($query, ":oraszam", $oraszam);
oci_bind_by_name($query, ":nap", $nap);
oci_bind_by_name($query, ":kezdet", $kezdet);
oci_bind_by_name($query, ":veg", $veg);
oci_bind_by_name($query, ":teremnev", $teremnev);
oci_bind_by_name($query, ":targy_kod", $targy_kod);
oci_bind_by_name($query, ":jelentkezok_szama", $jelentkezokszama);
oci_bind_by_name($query, ":zart", $zart);

$result_kurzus = oci_execute($query, OCI_DEFAULT);

if ($result_kurzus) {
    // Commit the transaction
    oci_commit($conn);
    echo "Data inserted into kurzus table successfully!";
    header("location: ../php/kurzusListaz.php");

} else {
    // Rollback the transaction
    oci_rollback($conn);
    $error_message = oci_error($query);
    echo "Error inserting data into kurzus table: " . $error_message['message'];
}


?>
