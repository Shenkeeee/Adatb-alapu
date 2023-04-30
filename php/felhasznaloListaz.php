<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";

require "../tools/connect.php";

require_once "../tools/adminvizsgalat.php";


$stid = oci_parse($conn, 'SELECT eha_kod, vezetek, keresztnev, email FROM felhasznalo');
oci_execute($stid);


?> <form action="./felhasznaloHozzaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "EHA-kod" . "</td>\n";
echo "    <td>" . "Vezeteknev" . "</td>\n";
echo "    <td>" . "Keresztnev" . "</td>\n";
echo "    <td>" . "Email" . "</td>\n";

echo "</tr>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    ?> <form action="../php/felhasznaloModosit.php" method="POST"><?php
    ?> <input type="hidden" name="ehakod" value="<?php echo $row["EHA_KOD"]  ?>"> <?php
    ?> <input type="hidden" name="vezetek" value="<?php echo $row["VEZETEK"]  ?>"> <?php
    ?> <input type="hidden" name="keresznev" value="<?php echo $row["KERESZTNEV"]  ?>"> <?php
    ?> <input type="hidden" name="email" value="<?php echo $row["EMAIL"]  ?>"> <?php
//    ?><!-- <input type="hidden" name="jelszo" value="--><?php //echo $row["JELSZO"]  ?><!--"> --><?php
    echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/felhasznaloTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="ehakod" value=<?php echo $row["EHA_KOD"] ?>> <?php
    echo "    <td> <Button type='submit'> Torol </Button></td>\n";
    ?> </form><?php

    echo "</tr>\n";
}
echo "</table>\n";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="../css/listaz.css" rel="stylesheet">


    <title>Felhasznalo Listaz</title>
</head>
<body>

</body>
</html>
