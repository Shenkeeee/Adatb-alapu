<?php
require_once "../tools/navbar.php";

require "../tools/connect.php";

require "../tools/connect.php";

$rowsadmin = "";

// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin

$stid2 = oci_parse($conn, 'SELECT eha_kod FROM hallgato');
oci_execute($stid2);



// felhasznalokhoz

$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo');
oci_execute($stid);

$ehakod = $_POST["ehakod"];
$atlag = $_POST["atlag"];
$szak = $_POST["szak"];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Hallgato módosít</title>
</head>
<body>
<h1>Hallgato módosítása </h1>

<form action="../tools/hallgatoModositTool.php" method="POST">

    EHA_KOD
    <input disabled value="<?php echo $ehakod ?>">   <br>
    <input name="ehakod" type="hidden" value="<?php echo $ehakod ?>">

    Atlag
    <input type="number" name="atlag" placeholder="<?php echo $atlag ?>">  <br>

    SzakID (1-30)
    <input name="szak" placeholder="<?php echo $szak ?>"> <br>

    <button type="submit" >Modosit</button> <br>
</form>

</body>
</html>
