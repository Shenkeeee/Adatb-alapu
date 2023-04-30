<?php
require_once "../tools/navbar.php";

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}
require "../tools/connect.php";

$stid = oci_parse($conn, 'SELECT * FROM resztvesz');
oci_execute($stid);


?> <form action="./resztveszHozzaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Hallgato EHA-kod" . "</td>\n";
echo "    <td>" . "Kurzuskod" . "</td>\n";
echo "    <td>" . "Erdemjegy" . "</td>\n";

echo "</tr>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    ?> <form action="../tools/resztveszModositTool.php" method="POST"><?php
    ?> <input type="hidden" name="ehakod" value="<?php echo $row["HALLGATO_EHA_KOD"]  ?>"> <?php
    ?> <input type="hidden" name="kurzuskod" value=<?php echo $row["KURZUS_KOD"] ?>> <?php

    echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/resztveszTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="ehakod" value="<?php echo $row["HALLGATO_EHA_KOD"]  ?>"> <?php
    ?> <input type="hidden" name="kurzuskod" value=<?php echo $row["KURZUS_KOD"] ?>> <?php
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


    <title>Resztvesz Listaz</title>
</head>
<body>

</body>
</html>
