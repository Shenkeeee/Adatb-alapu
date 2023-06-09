<?php
require_once "../tools/navbar.php";

require "../tools/connect.php";

$query2 = 'SELECT TEREMNEV FROM TEREM';

// execute the query
$stid2 = oci_parse($conn, $query2);
oci_execute($stid2);

$query = 'SELECT TARGY_KOD FROM TARGY';
$stid = oci_parse($conn, $query);
oci_execute($stid);


// Generate new vizsgakod
$max_vizsgakod_query = oci_parse($conn, 'SELECT MAX(azonosito) FROM vizsga');
oci_execute($max_vizsgakod_query);
$max_vizsgakod_result = oci_fetch_assoc($max_vizsgakod_query);
$max_vizsgakod = $max_vizsgakod_result['MAX(AZONOSITO)'];
if ($max_vizsgakod == null) {
    $azonosito = 'VIZ001';
} else {
    $new_vizsgakod_num = intval(substr($max_vizsgakod, 3)) + 1;
    $azonosito = 'VIZ' . str_pad($new_vizsgakod_num, 3, '0', STR_PAD_LEFT);
}




?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Felhasználó hozzáad</title>
</head>
<body>
<h1>Felhasználó hozzáadása</h1>

<form action="../tools/vizsgaHozzaadTool.php" method="POST">

    Azonosito <?php echo $azonosito ?>
    <input type="hidden" name="azonosito" value="<?php echo $azonosito; ?>">  <br>

    Tipus
    <select name="tipus">
        <option value="1" >Írásbeli</option>
        <option value="2" >Szóbeli</option>
    </select>

        Targykod
        <select name="targy_kod">
            <?php
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $targy_kod = $row['TARGY_KOD'];
                echo "<option value=\"$targy_kod\">$targy_kod</option>";
            }
            ?>
        </select><br>


        Teremnev
        <select name="teremnev">
            <?php
            while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $teremnev = $row['TEREMNEV'];
                echo "<option value=\"$teremnev\">$teremnev</option>";
            }
            ?>
        </select><br>

        Letszam
        <input type="number" name="letszam">  <br>



        <label for="kezdet_date">Kezdő dátum:</label>
        <input type="date" id="kezdet_date" name="kezdet_date">
        <input type="number" id="kezdet_hour" name="kezdet_hour" min="0" max="23" placeholder="Óra" required>
        <input type="number" id="kezdet_minute" name="kezdet_minute" min="0" max="59" placeholder="Perc" required>
        <br>
        <label for="veg_date">Vég dátum:</label>
        <input type="date" id="veg_date" name="veg_date">
        <input type="number" id="veg_hour" name="veg_hour" min="0" max="23" placeholder="Óra" required>
        <input type="number" id="veg_minute" name="veg_minute" min="0" max="59" placeholder="Perc" required>
        <br>



        <button type="submit">Hozzaad</button> <br>
</form>


</body>
</html>
