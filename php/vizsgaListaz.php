

<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";


require "../tools/connect.php";
require_once "../tools/adminvizsgalat.php";






//elj1

// Execute the stored procedure
$sql = 'BEGIN vizsgak_szama(:p_vizsgak_szama); END;';
$stmt = oci_parse($conn, $sql);
$vizsgak_szama = null; // Variable to store the output parameter
oci_bind_by_name($stmt, ':p_vizsgak_szama', $vizsgak_szama, 12);
oci_execute($stmt);

// Retrieve the output parameter value
oci_fetch($stmt);
$vizsgak_szama = oci_result($stmt, 'P_VIZSGAK_SZAMA');






$stid = oci_parse($conn, 'SELECT * FROM vizsga');
oci_execute($stid);

$stid2 = oci_parse($conn, "SELECT * FROM vizsga WHERE azonosito IN (SELECT azonosito FROM vizsgaztat WHERE vizsgaztat.eha_kod='$username')");
oci_execute($stid2);

$mivagyok = $stid;


				$sqlp = "SELECT * FROM oktato  WHERE eha_kod='$username'";

				$stmt = oci_parse($conn, $sqlp);
				if ($stmt){
					oci_execute($stmt, OCI_DEFAULT);
					oci_fetch($stmt);
					$kk = oci_result($stmt,"EHA_KOD");
					if ($kk == $username) {
						$mivagyok = $stid2;

					}
					oci_free_statement($stmt);

				}



?> <form action="./vizsgaHozzaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Azonosito" . "</td>\n";
echo "    <td>" . "Tipus" . "</td>\n";
echo "    <td>" . "Kezdet" . "</td>\n";
echo "    <td>" . "Veg" . "</td>\n";
echo "    <td>" . "Teremnev" . "</td>\n";
echo "    <td>" . "Letszam" . "</td>\n";

echo "</tr>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    ?> <form action="./vizsgaModosit.php" method="POST"><?php
    ?> <input type="hidden" name="azonosito" value="<?php echo $row["AZONOSITO"] ?>"> <?php
    ?> <input type="hidden" name="tipus" value="<?php echo $row["TIPUS"] ?>"> <?php
    ?> <input type="hidden" name="kezdet" value="<?php echo $row["KEZDET"]  ?>"> <?php
    ?> <input type="hidden" name="veg" value="<?php echo $row["VEG"]  ?>"> <?php
    ?> <input type="hidden" name="teremnev" value="<?php echo $row["TEREMNEV"]  ?>"> <?php
    ?> <input type="hidden" name="letszam" value="<?php echo $row["LETSZAM"]  ?>"> <?php

    echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/vizsgaTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="azonosito" value=<?php echo $row["AZONOSITO"] ?>> <?php
    echo "    <td> <Button type='submit'> Torol </Button></td>\n";
    ?> </form><?php
	echo " <td> <a href='vizsgahallgatoi.php?kurzuskód=".$row["AZONOSITO"]."'> Hallgatók </a>  </td>";
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

    <title>Vizsga Listaz</title>
</head>
<body>

<p>Jelenleg <?php echo $vizsgak_szama; ?> Vizsga van összesen. </p>

</body>
</html>
