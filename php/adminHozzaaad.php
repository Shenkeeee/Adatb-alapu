<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";
require "../tools/connect.php";



require_once "../tools/adminvizsgalat.php";

require "../tools/connect.php";



$rowsadmin = "";

// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin

$stid2 = oci_parse($conn, 'SELECT eha_kod FROM adminisztrator');
oci_execute($stid2);



// felhasznalokhoz

$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo');
oci_execute($stid);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/listaz.css">
    <title>Admin hozzáad</title>
</head>
<body>
<h1>Admin hozzáadása </h1>

<form action="../tools/adminHozzaaadTool.php" method="POST">
    EHA_KOD
    <select name="ehakod">
        <?php
        $rowAdmin = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS);

        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {

            $i = 0;
            foreach ($row as $item) {
                if($rowsadmin[$i] !== $row[$i]){
                    ?>         <option name="ehakod" value="<?php echo $row['EHA_KOD'] ?>">  <?php echo $row['EHA_KOD'] ?>  </option>
                    <?php $i++; }
            }
        }
        ?>
    </select><br>
    <button type="submit">Hozzaad</button> <br>
</form>

</body>
</html>
