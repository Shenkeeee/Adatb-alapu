<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";
require "../tools/connect.php";

require_once "../tools/adminvizsgalat.php";

$stid = oci_parse($conn, 'SELECT * FROM szak');
oci_execute($stid);


?> <form action="./szakHozzaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "SzakID" . "</td>\n";
echo "    <td>" . "Szaknev" . "</td>\n";

echo "</tr>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    ?> <form action="./szakModosit.php" method="POST"><?php
    ?> <input type="hidden" name="szakid" value="<?php echo $row["SZAKID"] ?>"> <?php
    ?> <input type="hidden" name="szaknev" value="<?php echo $row["SZAKNEV"] ?>"> <?php
    echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/szakTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="szakid" value=<?php echo $row["SZAKID"] ?>> <?php
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


    <title>Szak Listaz</title>
</head>
<body>

</body>
</html>
