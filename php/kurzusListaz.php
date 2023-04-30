<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";

require "../tools/connect.php";

$stid = oci_parse($conn, 'SELECT * FROM kurzus');
oci_execute($stid);

$stid2 = oci_parse($conn, "SELECT kurzus.kod,kurzus.nev,kurzus.kredit,kurzus.oraszam,kurzus.nap,kurzus.kezdet,kurzus.veg,kurzus.teremnev,kurzus.targy_kod,kurzus.zart FROM kurzus WHERE kurzus.kod IN (SELECT kurzus_kod FROM tart WHERE tart.oktato_eha_kod='$username') ORDER BY kurzus.nev");
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

?> <form action="./kurzusHozzaaad.php" method="POST"><?php
    echo "    <td> <Button type='submit'> Hozzaad </Button></td>\n";
?> </form><?php

echo "<table border='1'>\n";
echo "<tr>\n";
echo "    <td>" . "Kod" . "</td>\n";
echo "    <td>" . "Nev" . "</td>\n";
echo "    <td>" . "Kredit" . "</td>\n";
echo "    <td>" . "Oraszam" . "</td>\n";
echo "    <td>" . "Nap" . "</td>\n";
echo "    <td>" . "Kezdet" . "</td>\n";
echo "    <td>" . "Veg" . "</td>\n";
echo "    <td>" . "Teremnev" . "</td>\n";
echo "    <td>" . "Targykod" . "</td>\n";
echo "	  <td>" . "Zárt-e (0-nem, 1-igen)" . "</td>\n";
echo "	  <td>" . "Zárás/nyitás" . "</td>\n";
echo "    <td>" . "Módosítás" . "</td>\n";
echo "    <td>" . "Törlés" . "</td>\n";
echo "    <td>" . "Hallgatók" . "</td>\n";


echo "</tr>\n";

while ($row = oci_fetch_array($mivagyok, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
	
	if($row['ZART']==0) {
		echo "<td> <a href='zaras.php?kod=".$row["KOD"]."'> Zárás </a>  </td>";
	}
	else { 
		echo "<td> <a href='zaras.php?kod=".$row["KOD"]."'> Nyitás </a>  </td>";
	}
	
	
	
    ?> <form action="./kurzusModosit.php" method="POST"><?php
    ?> <input type="hidden" name="kod" value="<?php echo $row["KOD"] ?>"> <?php
    ?> <input type="hidden" name="nev" value="<?php echo $row["NEV"]  ?>"> <?php
    ?> <input type="hidden" name="kredit" value="<?php echo $row["KREDIT"]  ?>"> <?php
    ?> <input type="hidden" name="oraszam" value="<?php echo $row["ORASZAM"]  ?>"> <?php
    ?> <input type="hidden" name="nap" value="<?php echo $row["NAP"]  ?>"> <?php
    ?> <input type="hidden" name="kezdet" value="<?php echo $row["KEZDET"]  ?>"> <?php
    ?> <input type="hidden" name="veg" value="<?php echo $row["VEG"]  ?>"> <?php
    ?> <input type="hidden" name="teremnev" value="<?php echo $row["TEREMNEV"]  ?>"> <?php
    ?> <input type="hidden" name="targy_kod" value="<?php echo $row["TARGY_KOD"]  ?>"> <?php
    ?> <input type="hidden" name="zart" value="<?php echo $row["ZART"]  ?>"> <?php




        echo "    <td> <Button type='submit'> Modosit </Button></td>\n";
    ?> </form><?php

    ?> <form action="../tools/kurzusTorolTool.php" method="POST"><?php
    ?> <input type="hidden" name="kod" value=<?php echo $row["KOD"] ?>> <?php
    echo "    <td> <Button type='submit'> Torol </Button></td>\n";
    ?> </form><?php
	
	echo " <td> <a href='kurzushallgatoi.php?kurzuskód=".$row["KOD"]."'> Hallgatók </a>  </td>";

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
    
    <title>Kurzus Listaz</title>
</head>
<body>

</body>
</html>
