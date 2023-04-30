<?php
require_once "../tools/navbar.php";
require "../tools/connect.php";

$rowsadmin = "";

// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin
$stid2 = oci_parse($conn, 'SELECT eha_kod FROM oktato');
oci_execute($stid2);

// felhasznalokhoz, akik még nem hallgatók
$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo WHERE eha_kod NOT IN (SELECT eha_kod FROM oktato)');
oci_execute($stid);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">
    <title>Oktato hozzáad</title>
</head>
<body>
<h1>Oktato hozzáadása </h1>

<form action="../tools/oktatoHozzaaadTool.php" method="POST">
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


    Beosztas
    <input name="beosztas">  <br>

    <button type="submit">Hozzaad</button> <br>
</form>

</body>
</html>
