<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require_once "../tools/navbar.php";

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";

$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

require_once "../tools/adminvizsgalat.php";

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";


$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin

$stid2 = oci_parse($conn, 'SELECT eha_kod FROM adminisztrator');
oci_execute($stid2);



// felhasznalokhoz

$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo');
oci_execute($stid);

$ehakod = $_POST["ehakod"];
$vezetek = $_POST["vezetek"];
$keresztnev = $_POST["keresznev"];
$email = $_POST["email"];
//$jelszo = $_POST["jelszo"];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Felhasználó módosít</title>
</head>
<body>
<h1>Felhasználó módosítása</h1>

<form action="../tools/felhasznaloModositTool.php" method="POST">

    Eha-kod
<input disabled value="<?php echo $ehakod ?>">   <br>
<input name="ehakod" type="hidden" value="<?php echo $ehakod ?>">


    Vezeteknev
<input name="vezeteknev" placeholder="<?php echo $vezetek ?>">  <br>

    Keresztnev
<input name="keresztnev" placeholder="<?php echo $keresztnev ?>">  <br>

    Email
<input type="email" name="email" placeholder="<?php echo $email ?>">  <br>

    Jelszo
<!--<input name="pass" placeholder="--><?php //echo $jelszo ?><!--">  <br>-->
<input type="password" name="pass" >  <br>

    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>
