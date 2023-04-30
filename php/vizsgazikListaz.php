<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";

require "../tools/connect.php";

require_once "../tools/adminvizsgalat.php";


$stid = oci_parse($conn, 'SELECT * FROM vizsgazik');
oci_execute($stid);


?> <form action="./vizsgazikHozzaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Azonosito" . "</td>\n";
echo "    <td>" . "Hallgato EHA-kod" . "</td>\n";
echo "    <td>" . "Erdemjegy" . "</td>\n";

echo "</tr>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    ?> <form action="../tools/vizsgazikModositTool.php" method="POST"><?php
    ?> <input type="hidden" name="ehakod" value="<?php echo $row["EHA_KOD"]  ?>"> <?php
    ?> <input type="hidden" name="azonosito" value=<?php echo $row["AZONOSITO"] ?>> <?php
    echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/vizsgazikTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="ehakod" value="<?php echo $row["EHA_KOD"]  ?>"> <?php
    ?> <input type="hidden" name="azonosito" value=<?php echo $row["AZONOSITO"] ?>> <?php
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


    <title>Vizsgazik Listaz</title>
</head>
<body>

</body>
</html>
