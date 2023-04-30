<?php
require_once "../tools/navbar.php";

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";

$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";


$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$rowsadmin = "";

$query = 'SELECT TARGY_KOD FROM TARGY';
$stid = oci_parse($conn, $query);
oci_execute($stid);



$query2 = 'SELECT TEREMNEV FROM TEREM';

// execute the query
$stid2 = oci_parse($conn, $query2);
oci_execute($stid2);



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">
    <title>Kurzus hozzáad</title>
</head>
<body>
<h1>Kurzus hozzáadása </h1>

<form action="../tools/kurzusHozzaadTool.php" method="POST">


    Targykod
    <select name="targy_kod">
        <?php
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $targy_kod = $row['TARGY_KOD'];
            echo "<option value=\"$targy_kod\">$targy_kod</option>";
        }
        ?>
    </select><br>

    Teremnév
    <select name="teremnev">
        <?php
        while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $teremnev = $row['TEREMNEV'];
            echo "<option value=\"$teremnev\">$teremnev</option>";
        }
        ?>
    </select><br>




    Név
    <input name="nev">  <br>

    Kod
    <input name="kod">  <br>


    Kredit
    <input type="number" name="kredit" >  <br>

    Oraszam
    <input type="number" name="oraszam" >  <br>

    Nap
    <input name="nap">  <br>

    Kezdet
    <input type="date" name="kezdet">  <br>


    Vég
    <input type="date" name="veg">  <br>





    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>


