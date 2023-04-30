<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

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

require_once "../tools/adminvizsgalat.php";


$stid = oci_parse($conn, 'SELECT * FROM targy');
oci_execute($stid);


?> <form action="./targyHozzaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Targykod" . "</td>\n";
echo "    <td>" . "Nev" . "</td>\n";
echo "    <td>" . "Ajanlott felev" . "</td>\n";
echo "    <td>" . "Oraszam" . "</td>\n";
echo "    <td>" . "SzakID" . "</td>\n";

echo "</tr>\n";

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

    echo "</tr>\n";
}
echo "</table>\n";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="../css/listaz.css" rel="stylesheet">


    <title>Targy Listaz</title>
</head>
<body>

</body>
</html>
