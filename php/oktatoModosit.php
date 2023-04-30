<?php
require_once "../tools/navbar.php";
require "../tools/connect.php";


if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$rowsadmin = "";

// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin

$stid2 = oci_parse($conn, 'SELECT eha_kod FROM oktato');
oci_execute($stid2);



// felhasznalokhoz

$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo');
oci_execute($stid);

$ehakod = $_POST["ehakod"];
$beosztas = $_POST["beosztas"];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Oktato módosít</title>
</head>
<body>
<h1>Oktato módosítása</h1>

<form action="../tools/oktatoModositTool.php" method="POST">

    EHA_KOD
    <input disabled value="<?php echo $ehakod ?>">   <br>
    <input name="ehakod" type="hidden" value="<?php echo $ehakod ?>">

    Beosztas
    <input name="beosztas" placeholder="<?php echo $beosztas ?>">  <br>

    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>
