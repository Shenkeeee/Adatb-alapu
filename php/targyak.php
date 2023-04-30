<html>
<head>
    <link href="../css/listaz.css" rel="stylesheet">
</head>

<?php

require_once "../tools/navbar.php";
require "../tools/connect.php";



session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
     header("Location: bejelentkezes.php");
	}

$stid = oci_parse($conn, 'SELECT targy.targy_kod,targy.nev,COUNT(kurzus.kod) "Kurzusok száma" FROM kurzus,targy WHERE kurzus.targy_kod=targy.targy_kod GROUP BY targy.nev,targy.targy_kod');
oci_execute($stid);

echo "<table border='1'>\n";

echo "<tr>";
echo "<td> Tárgykód </td>";
echo "<td> Tárgy név </td>";
echo "<td> Kurzusok száma </td>";
echo "<td> Kurzusok </td>";
echo "<td> Résztvevők száma </td>";
echo "<td> Módisít </td>";
echo "<td> Töröl </td>";
echo "</tr>";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }

    ?> <form action="../php/targyModosit.php" method="POST"><?php
    ?> <input type="hidden" name="targykod" value="<?php echo $row["TARGY_KOD"] ?>"> <?php
    ?> <input type="hidden" name="nev" value="<?php echo $row["NEV"] ?>"> <?php
    ?> <input type="hidden" name="ajanlottfelev" value="<?php echo $row["AJANLOTT_FELEV"] ?>"> <?php
    ?> <input type="hidden" name="oraszam" value="<?php echo $row["ORA_SZAM"] ?>"> <?php
    ?> <input type="hidden" name="szakid" value="<?php echo $row["SZAKID"] ?>"> <?php

    echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/targyTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="targykod" value=<?php echo $row["TARGY_KOD"] ?>> <?php
    echo "    <td> <Button type='submit'> Torol </Button></td>\n";
    ?> </form><?php



    //2. elj
    $targy_kod = $row["TARGY_KOD"];
    $kurzusok_szama = 0;

    $query = oci_parse($conn, 'BEGIN kurzusok_szama(:p_targy_kod, :p_kurzusok_szama); END;');
    oci_bind_by_name($query, ':p_targy_kod', $targy_kod);
    oci_bind_by_name($query, ':p_kurzusok_szama', $kurzusok_szama);
    oci_execute($query);

    echo "<td>" . $kurzusok_szama . "</td>";

    //

//    4. eljaras

    $resztvevok_szama = 0;

    $query = oci_parse($conn, 'BEGIN targy_resztvevok_szama(:p_targy_kod, :p_resztvevok_szama); END;');
    oci_bind_by_name($query, ':p_targy_kod', $targy_kod);
    oci_bind_by_name($query, ':p_resztvevok_szama', $resztvevok_szama);
    oci_execute($query);

    echo "<td>" . $resztvevok_szama . "</td>";





	echo  "<td> <a href='Kurzusok.php?tárgykód=".$row["TARGY_KOD"]."'> Megtekintés </a>  </td>";
	//echo "<td>".$row["TARGY_KOD"]."</td>";
    echo "</tr>\n";
}
echo "</table>\n";


?>
</html>