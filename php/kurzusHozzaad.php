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


// Generate new kurzuskod
$max_kurzuskod_query = oci_parse($conn, 'SELECT MAX(kod) FROM kurzus');
oci_execute($max_kurzuskod_query);
$max_kurzuskod_result = oci_fetch_assoc($max_kurzuskod_query);
$max_kurzuskod = $max_kurzuskod_result['MAX(KOD)'];
if ($max_kurzuskod == null) {
    $kurzuskod = 'K001';
} else {
    $new_kurzuskod_num = intval(substr($max_kurzuskod, 1)) + 1;
    $kod = 'K' . str_pad($new_kurzuskod_num, 3, '0', STR_PAD_LEFT);
}




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

    Kurzuskod <?php echo $kod; ?>
    <input name="kod" type="hidden" value="<?php echo $kod; ?>">  <br>


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


    Jelentkezők száma 0
    <input type="hidden" name="jelentkezokszama" value="0">  <br>


    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>


