<?php
require_once "../tools/navbar.php";
require "../tools/connect.php";

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
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Targy hozzáad</title>
</head>
<body>
<h1>Targy hozzáadása</h1>

<form action="../tools/targyHozzaaadTool.php" method="POST">

    Targykod
<input name="targykod">  <br>

    Nev
<input name="nev">  <br>

    Ajanlott felev
<input type="number" name="ajanlottfelev">  <br>

    Oraszam
<input type="number" name="oraszam">  <br>

    SzakID
<input name="szakid">  <br>

    <button type="submit">Hozzaad</button> <br>
</form>

</body>
</html>
