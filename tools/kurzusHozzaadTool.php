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


$oktato_EHA_kod= $username;

echo $kredit . " ot adom hozza elv " . ' <br>';



// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
$query = oci_parse($conn, "INSERT INTO kurzus (kod, nev, kredit, oraszam, nap, kezdet, veg, teremnev, targy_kod) 
                            VALUES (:kod, :nev, :kredit, :oraszam, :nap, TO_DATE(:kezdet, 'YYYY-MM-DD'), TO_DATE(:veg, 'YYYY-MM-DD'), :teremnev, :targy_kod)");

$kurzus_kod = "ABC"; // replace with the actual kurzus_kod value
$query_tart = oci_parse($conn, "INSERT INTO Tart (oktato_EHA_kod, kurzus_kod) 
                                 VALUES (:oktato_EHA_kod, :kurzus_kod)");

oci_bind_by_name($query, ":kod", $kod);
oci_bind_by_name($query, ":nev", $nev);
oci_bind_by_name($query, ":kredit", $kredit);
oci_bind_by_name($query, ":oraszam", $oraszam);
oci_bind_by_name($query, ":nap", $nap);
oci_bind_by_name($query, ":kezdet", $kezdet);
oci_bind_by_name($query, ":veg", $veg);
oci_bind_by_name($query, ":teremnev", $teremnev);
oci_bind_by_name($query, ":targy_kod", $targy_kod);

$result_kurzus = oci_execute($query, OCI_DEFAULT);

if($result_kurzus) {
    oci_bind_by_name($query_tart, ":oktato_EHA_kod", $oktato_EHA_kod);
    oci_bind_by_name($query_tart, ":kurzus_kod", $kod);

    $result_tart = oci_execute($query_tart, OCI_DEFAULT);

    if($result_tart) {
        oci_commit($conn);
        echo "Data Added succesfully.";
        header("location: ../php/kurzusListaz.php");
    } else {
        oci_rollback($conn);
        echo "Error adding data to Tart table.";
    }
} else {
    oci_rollback($conn);
    echo "Error adding data to Kurzus table.";
}


?>
