<?php
require_once "../tools/navbar.php";

require "../tools/connect.php";


$rowsadmin = "";



$query = 'SELECT TARGY_KOD FROM TARGY';
$stid = oci_parse($conn, $query);
oci_execute($stid);



$query2 = 'SELECT TEREMNEV FROM TEREM';
// execute the query
$stid2 = oci_parse($conn, $query2);
oci_execute($stid2);


/*
$stid = oci_parse($conn, 'SELECT kod FROM kurzus');
oci_execute($stid);
*/

$azonosito = $_POST["azonosito"];
$tipus = $_POST["tipus"];
$kezdet = $_POST["kezdet"];
$veg = $_POST["veg"];
$teremnev = $_POST["teremnev"];
$letszam = $_POST["letszam"];
$targy_kod = $_POST["targy_kod"];



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Kurzus módosít</title>
</head>
<body>
<h1>Kurzus módosítása</h1>

<form action="../tools/kurzusModositTool.php" method="POST">

    $azonosito = $_POST["azonosito"];
    $tipus = $_POST["tipus"];
    $kezdet = $_POST["kezdet"];
    $veg = $_POST["veg"];
    $teremnev = $_POST["teremnev"];
    $letszam = $_POST["letszam"];
    $targy_kod = $_POST["targy_kod"];




    Azonosito
    <label name="azonosito" placeholder="<?php echo $azonosito; ?>">  <br>


    Tipus
    <select name="tipus">
        <option value="1" >Írásbeli</option>
        <option value="2" >Szóbeli</option>
    </select>



    Kezdet
    <input type="date" name="kezdet">  <br>


    Vég
    <input type="date" name="veg">  <br>


    Teremnév
    <select name="teremnev">
        <?php
        while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $teremnev = $row['TEREMNEV'];
            echo "<option value=\"$teremnev\">$teremnev</option>";
        }
        ?>
    </select><br>


    Létszám
    <input type="number" name="letszam" value="<?php echo $letszam ?>">  <br>


    Targykod
    <select name="targy_kod">
        <?php
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $targy_kod = $row['TARGY_KOD'];
            echo "<option value=\"$targy_kod\">$targy_kod</option>";
        }
        ?>
    </select><br>




    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>

